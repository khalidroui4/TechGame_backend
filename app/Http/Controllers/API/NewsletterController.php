<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ]);

        $email = $request->email;
        
        // Save to database
        \App\Models\Newsletter::create(['email' => $email]);

        $subject = "Votre Code de Réduction TECHGAME";
        
        try {
            Mail::send([], [], function ($message) use ($email, $subject) {
                $message->to($email)
                        ->subject($subject)
                        ->html("
                            <div style='background: #020c06; color: white; padding: 40px; font-family: sans-serif; border: 1px solid #39ff14;'>
                                <h1 style='color: #39ff14;'>Bienvenue dans l'Élite TECHGAME !</h1>
                                <p>Merci d'avoir rejoint notre communauté de passionnés.</p>
                                <div style='background: rgba(57, 255, 20, 0.1); padding: 20px; border-radius: 10px; margin: 20px 0;'>
                                    <p style='font-size: 1.2rem;'>Votre code de réduction de 30% est :</p>
                                    <h2 style='color: #39ff14; letter-spacing: 5px;'>TECHGAME30</h2>
                                </div>
                                <p>Vous serez désormais informé en avant-première de nos nouveaux arrivages et des alertes de stock.</p>
                                <p>L'équipe TECHGAME</p>
                            </div>
                        ");
            });
            return response()->json(['message' => 'Inscription réussie et email envoyé.'], 200);
        } catch (\Exception $e) {
            // Even if mail fails, we have the subscription saved
            return response()->json(['message' => 'Inscription réussie.', 'email_status' => 'Email non envoyé'], 201);
        }
    }
}
