<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        try {
            $this->notifySubscribers("Nouveau Produit : " . $product->name, "
                <div style='background: #020c06; color: white; padding: 40px; font-family: sans-serif; border: 1px solid #39ff14;'>
                    <h1 style='color: #39ff14;'>Nouvel Arrivage Élite !</h1>
                    <p>Le produit <strong>" . $product->name . "</strong> est désormais disponible dans notre catalogue.</p>
                    <p>Prix : <strong>" . number_format($product->price, 0, ',', ' ') . " DH</strong></p>
                    <div style='margin-top: 30px;'>
                        <a href='https://techgame.ma/product/" . $product->id . "' style='background: #39ff14; color: black; padding: 15px 30px; text-decoration: none; font-weight: bold; border-radius: 5px;'>Voir le produit</a>
                    </div>
                </div>
            ");
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Newsletter notify failed on create: " . $e->getMessage());
        }
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        try {
            // Check if it's now out of stock
            if ($product->isDirty('stock') && $product->stock == 0) {
                $this->notifySubscribers("Alerte Stock : " . $product->name, "
                    <div style='background: #020c06; color: white; padding: 40px; font-family: sans-serif; border: 1px solid #ff3131;'>
                        <h1 style='color: #ff3131;'>Alerte Rupture de Stock !</h1>
                        <p>Le produit <strong>" . $product->name . "</strong> est actuellement épuisé.</p>
                        <p>Ne vous inquiétez pas, nous travaillons déjà sur le réapprovisionnement. Restez à l'écoute !</p>
                    </div>
                ");
            }
            
            // Optional: Notify when back in stock
            if ($product->isDirty('stock') && $product->stock > 0 && $product->getOriginal('stock') == 0) {
                 $this->notifySubscribers("Retour en Stock : " . $product->name, "
                    <div style='background: #020c06; color: white; padding: 40px; font-family: sans-serif; border: 1px solid #39ff14;'>
                        <h1 style='color: #39ff14;'>De retour en Stock !</h1>
                        <p>Bonne nouvelle ! Le produit <strong>" . $product->name . "</strong> est à nouveau disponible.</p>
                        <div style='margin-top: 30px;'>
                            <a href='https://techgame.ma/product/" . $product->id . "' style='background: #39ff14; color: black; padding: 15px 30px; text-decoration: none; font-weight: bold; border-radius: 5px;'>Acheter maintenant</a>
                        </div>
                    </div>
                ");
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Newsletter notify failed on update: " . $e->getMessage());
        }
    }

    private function notifySubscribers($subject, $htmlContent)
    {
        $subscribers = Newsletter::all();
        
        foreach ($subscribers as $subscriber) {
            try {
                Mail::html($htmlContent, function ($message) use ($subscriber, $subject) {
                    $message->to($subscriber->email)
                            ->subject($subject);
                });
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}
