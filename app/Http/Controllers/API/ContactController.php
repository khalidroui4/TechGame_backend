<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:200',
            'message' => 'required|string|max:2000',
        ]);

        try {
            Mail::send('emails.contact', ['data' => $validated], function($message) use ($validated) {
                $message->to('rouibaa.khalid05@gmail.com', 'TECHGAME Admin')
                        ->subject('Nouveau Message de Contact - TECHGAME')
                        ->replyTo($validated['email'], $validated['name']);
            });

            return response()->json([
                'success' => true,
                'message' => 'Votre message a été envoyé avec succès.',
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur email contact: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi du message.',
            ], 500);
        }
    }
}
