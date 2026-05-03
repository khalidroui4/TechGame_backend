<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // Get all favorites for the authenticated user
    public function index(Request $request)
    {
        $favorites = $request->user()
            ->favorites()
            ->with('category')
            ->get();

        return response()->json($favorites);
    }

    // Toggle favorite (add if not exists, remove if exists)
    public function toggle(Request $request, $productId)
    {
        $user = $request->user();
        $product = Product::findOrFail($productId);

        // Check if already favorited via pivot table
        $isFavorited = $user->favorites()->where('products.id', $productId)->exists();

        if ($isFavorited) {
            $user->favorites()->detach($productId);
            return response()->json(['favorited' => false]);
        } else {
            $user->favorites()->attach($productId);
            return response()->json(['favorited' => true]);
        }
    }

    // Get list of favorited product IDs for the user (for UI state)
    public function ids(Request $request)
    {
        $ids = $request->user()->favorites()->pluck('products.id');
        return response()->json($ids);
    }
}
