<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\SupportAttachment;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller
{
    /**
     * Anonymous ticket creation (from IHOST system)
     */
    public function storeAnonymousTicket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        $ticketId = 'SUP-ANO-' . Str::upper(Str::random(6));

        $ticket = SupportTicket::create([
            'user_id' => null, // This requires nullable user_id in DB
            'ticket_id' => $ticketId,
            'subject' => $request->subject,
            'category' => 'Anonymous',
            'priority' => 'medium',
            'status' => 'pending',
        ]);

        if ($request->message) {
            SupportMessage::create([
                'user_id' => null,
                'ticket_id' => $ticket->id,
                'message' => $request->message,
                'is_from_admin' => false,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Ticket created (anonymous)',
            'ticket_id' => $ticketId
        ]);
    }

    // ==========================================
    // CLIENT METHODS
    // ==========================================

    // Get my tickets
    public function getTickets(Request $request)
    {
    $tickets = SupportTicket::where('user_id', $request->user()->id)
            ->with(['messages' => function($q) { $q->orderBy('created_at', 'asc')->with('attachments'); }])
            ->orderBy('updated_at', 'desc')
            ->get();
        return response()->json($tickets);
    }

    // Create a new ticket
    public function storeTicket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'message' => 'required|string',
            'order_id' => 'nullable|exists:orders,id',
            'attachments.*' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:5120', // 5MB limit, strict MIME check
        ]);

        $ticketId = 'SUP-' . date('Y') . '-' . Str::upper(Str::random(5));

        $ticket = SupportTicket::create([
            'user_id' => $request->user()->id,
            'ticket_id' => $ticketId,
            'subject' => $request->subject,
            'category' => $request->category,
            'priority' => $request->priority,
            'order_id' => $request->order_id,
            'status' => 'pending',
        ]);

        $message = SupportMessage::create([
            'user_id' => $request->user()->id,
            'ticket_id' => $ticket->id,
            'message' => $request->message,
            'is_from_admin' => false,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('support/attachments', 'public');
                SupportAttachment::create([
                    'support_message_id' => $message->id,
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return response()->json($ticket->load('messages.attachments'), 201);
    }

    // Get ticket details and messages
    public function getTicketDetails($id)
    {
        $ticket = SupportTicket::with(['messages.attachments', 'messages.user', 'order', 'assignedAgent'])
            ->findOrFail($id);
        
        // Security check
        if ($ticket->user_id && $ticket->user_id !== auth()->id() && !auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Mark messages as read if accessed by the owner
        if ($ticket->user_id === auth()->id()) {
            $ticket->messages()->where('is_from_admin', true)->update(['is_read' => true]);
        }

        return response()->json($ticket);
    }

    // Reply to a ticket
    public function replyToTicket(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);
        
        if ($ticket->user_id !== auth()->id() && !auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'message'       => 'nullable|string',
            'attachments'   => 'nullable|array',
            'attachments.*' => 'file|max:10240|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,zip,txt',
        ]);

        // Must have at least a message or an attachment
        if (!$request->message && !$request->hasFile('attachments')) {
            return response()->json(['message' => 'Message or attachment required'], 422);
        }

        $isAdmin = auth()->user()->is_admin;

        $message = SupportMessage::create([
            'user_id'      => auth()->id(),
            'ticket_id'    => $ticket->id,
            'message'      => $request->message ?? '',
            'is_from_admin' => $isAdmin,
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('support/attachments', 'public');
                SupportAttachment::create([
                    'support_message_id' => $message->id,
                    'file_path'  => $path,
                    'file_name'  => $file->getClientOriginalName(),
                    'file_type'  => $file->getClientMimeType(),
                ]);
            }
        }

        // Update ticket status
        if ($isAdmin) {
            $ticket->update(['status' => 'open']);
        } else {
            $ticket->update(['status' => 'pending']);
        }
        $ticket->touch();

        return response()->json($message->load('attachments'));
    }

    // ==========================================
    // ADMIN METHODS
    // ==========================================

    public function adminGetStats()
    {
        return response()->json([
            'total_tickets' => SupportTicket::count(),
            'open_tickets' => SupportTicket::whereIn('status', ['open', 'pending'])->count(),
            'resolved_today' => SupportTicket::where('status', 'resolved')->whereDate('updated_at', now())->count(),
            'urgent_tickets' => SupportTicket::where('priority', 'urgent')->whereIn('status', ['open', 'pending'])->count(),
        ]);
    }

    public function adminGetTickets(Request $request)
    {
        $query = SupportTicket::with(['user', 'messages' => function($q) { $q->orderBy('created_at', 'asc')->with('attachments'); }]);

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        return response()->json($query->orderBy('updated_at', 'desc')->paginate(15));
    }

    public function adminUpdateTicket(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $ticket->update($request->only(['status', 'priority', 'assigned_to']));
        return response()->json($ticket);
    }

    // ==========================================
    // LIVE CHAT (Legacy/Simple support)
    // ==========================================
    public function index(Request $request)
    {
        $messages = SupportMessage::where('user_id', $request->user()->id)
            ->whereNull('ticket_id') // Filter out ticket-related messages for simple live chat
            ->orderBy('created_at', 'asc')
            ->get();
        
        SupportMessage::where('user_id', $request->user()->id)
            ->whereNull('ticket_id')
            ->where('is_from_admin', true)
            ->update(['is_read' => true]);

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string|max:5000']);
        $message = SupportMessage::create([
            'user_id' => $request->user()->id,
            'message' => $request->message,
            'is_from_admin' => false,
        ]);
        return response()->json($message, 201);
    }
}
