<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    // Update name & email
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        // Sync localStorage
        return response()->json(['user' => $user->fresh()]);
    }

    // Change password
    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_password' => 'required',
            'password'         => ['required', 'confirmed', 'min:8', 'regex:/[0-9]/'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Mot de passe actuel incorrect.'], 422);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return response()->json(['message' => 'Mot de passe mis à jour avec succès.']);
    }

    // Upload avatar
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = $request->user();

        // Delete old avatar if exists
        if ($user->avatar && file_exists(storage_path('app/public/' . str_replace('/storage/', '', $user->avatar)))) {
            unlink(storage_path('app/public/' . str_replace('/storage/', '', $user->avatar)));
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $fullPath = '/storage/' . $path;
        $user->update(['avatar' => $fullPath]);

        return response()->json([
            'user'       => $user->fresh(),
            'avatar_url' => asset($fullPath),
        ]);
    }
    // List all users (Admin)
    public function index()
    {
        // Only return non-admin users
        $users = \App\Models\User::where('is_admin', false)
            ->withCount('orders')
            ->latest()
            ->get();
            
        return response()->json($users);
    }
}
