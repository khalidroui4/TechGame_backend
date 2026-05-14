<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');
        
        if ($request->has('category') && $request->category !== 'Tendances') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->category . '%');
            });
        }

        if ($request->has('trending') || $request->category === 'Tendances') {
            $query->where('is_trending', true);
        }
        
        return response()->json($query->latest()->get());
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,webp,avif,bmp|max:12288',
            'is_trending' => 'nullable|boolean'
        ]);

        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $product = Product::create($data);
        $product->load('category');

        AuditLog::log('created_product', Product::class, $product->id, ['name' => $product->name, 'price' => $product->price]);

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,webp,avif,bmp|max:12288',
            'is_trending' => 'nullable|boolean'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($product->image) {
                $oldPath = str_replace('/storage/', '', $product->image);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $product->update($data);
        $product->load('category');

        AuditLog::log('updated_product', Product::class, $product->id, ['updated_fields' => array_keys($data)]);

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            $oldPath = str_replace('/storage/', '', $product->image);
            Storage::disk('public')->delete($oldPath);
        }
        
        $productName = $product->name;
        $productId = $product->id;
        $product->delete();

        AuditLog::log('deleted_product', Product::class, $productId, ['name' => $productName]);

        return response()->json(['message' => 'Product deleted successfully']);
    }
    public function toggleTrending($id)
    {
        $product = Product::findOrFail($id);
        $product->is_trending = !$product->is_trending;
        $product->save();

        AuditLog::log('toggled_trending', Product::class, $product->id, ['is_trending' => $product->is_trending]);

        return response()->json([
            'message' => 'Product trending status updated',
            'is_trending' => $product->is_trending
        ]);
    }
}
