<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getStats()
    {
        $totalSales = Order::where('status', '!=', 'annulée')->sum('total_amount');
        $totalOrders = Order::count();
        $totalUsers = User::where('is_admin', false)->count();
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');

        return response()->json([
            'total_sales' => $totalSales,
            'total_orders' => $totalOrders,
            'total_users' => $totalUsers,
            'total_products' => $totalProducts,
            'total_stock' => $totalStock,
        ]);
    }
}
