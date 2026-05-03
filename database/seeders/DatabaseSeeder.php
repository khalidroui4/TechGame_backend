<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gamehawk.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Create a Client user
        User::create([
            'name' => 'John Client',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Create Categories
        $pcs = Category::create(['name' => 'Gaming PCs', 'description' => 'High-performance gaming rigs.']);
        $keyboards = Category::create(['name' => 'Keyboards', 'description' => 'Mechanical RGB keyboards.']);
        $mice = Category::create(['name' => 'Mice', 'description' => 'Precision gaming mice.']);
        $chairs = Category::create(['name' => 'Gaming Chairs', 'description' => 'Ergonomic racing-style chairs.']);
        $tables = Category::create(['name' => 'Gaming Tables', 'description' => 'RGB-lit gaming desks.']);
        $rgb = Category::create(['name' => 'RGB Lights', 'description' => 'Smart ambient lighting.']);
        $controllers = Category::create(['name' => 'Controllers', 'description' => 'Pro-level game controllers.']);
        $xbox = Category::create(['name' => 'Xbox', 'description' => 'Xbox consoles and accessories.']);
        $playstation = Category::create(['name' => 'PlayStation', 'description' => 'PS5 consoles and accessories.']);
        $tapis = Category::create(['name' => 'Mousepads', 'description' => 'Extended RGB gaming surfaces.']);

        // Create Products
        Product::create([
            'category_id' => $pcs->id,
            'name' => 'Apex Sentinel V1',
            'description' => 'Ultra-performance gaming PC with RTX 4090, 64GB RAM, and custom RGB liquid cooling.',
            'price' => 3499.00,
            'stock' => 10,
            'image' => '/pc_gaming.png',
        ]);

        Product::create([
            'category_id' => $keyboards->id,
            'name' => 'Nexus Mechanical RGB',
            'description' => 'Customizable mechanical keyboard with optical switches and per-key RGB lighting.',
            'price' => 189.00,
            'stock' => 50,
            'image' => '/keyboard_gaming.png',
        ]);

        Product::create([
            'category_id' => $playstation->id,
            'name' => 'PlayStation 5 Console',
            'description' => 'Experience lightning-fast loading with an ultra-high speed SSD and deeper immersion with haptic feedback.',
            'price' => 499.00,
            'stock' => 25,
            'image' => '/ps5_console.png',
        ]);

        Product::create([
            'category_id' => $xbox->id,
            'name' => 'Xbox Series X',
            'description' => 'The fastest, most powerful Xbox ever. Play thousands of titles from four generations of consoles.',
            'price' => 499.00,
            'stock' => 30,
            'image' => '/xbox_console.png',
        ]);

        Product::create([
            'category_id' => $chairs->id,
            'name' => 'Titan Pro Gaming Chair',
            'description' => 'Ergonomic racing-style chair with memory foam and 4D armrests for maximum comfort.',
            'price' => 399.00,
            'stock' => 15,
            'image' => '/hero_gaming.png', // Fallback
        ]);

        Product::create([
            'category_id' => $mice->id,
            'name' => 'Hawk Precision Pro',
            'description' => 'Ultra-lightweight 26k DPI gaming mouse with custom green Hawk LED accents.',
            'price' => 129.00,
            'stock' => 100,
            'image' => '/mouse_green.png',
        ]);
    }
}
