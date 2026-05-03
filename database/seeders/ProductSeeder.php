<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks to truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            "Gaming PCs" => [
                [
                    "name" => "Corsair Vengeance a7500",
                    "price" => 40000,
                    "description" => "VENGEANCE a7500 Gaming PC: AMD Ryzen 7 9800X3D, GeForce RTX 5080, 32GB DDR5, 2TB SSD, Win11 Home",
                    "image" => "/VENGEANCE_a7500.avif",
                ],
                [
                    "name" => "Alienware Area-51",
                    "price" => 70000,
                    "description" => "Intel® Core™ Ultra 9 285K, 24 cores, OS Windows 11 Home, NVIDIA® GeForce RTX™ 5090, 64 GB DDR5, 4 TB SSD",
                    "image" => "/desktop-alienware-area51.avif",
                ],
                [
                    "name" => "RDY Element 9 Pro R07",
                    "price" => 22000,
                    "description" => "Windows 11 Home, AMD Ryzen™ 7 7800X3D, AMD Radeon RX 9070 XT 16GB, 32GB DDR5-6000MHz, 2TB M.2 NVMe Gen4 SSD",
                    "image" => "/gaming-pc-01-RDY-Element9Pro-R07.avif",
                ],
                [
                    "name" => "Lenovo Legion 7i Gen 10",
                    "price" => 59000,
                    "description" => "Intel® Core™ Ultra 9 285K (up to 5.50 GHz), Windows 11 Pro, 64 GB DDR5-5600MT/s, 2TB Gen 5 SSD, RTX™ 5090 32GB GDDR7",
                    "image" => "/Lenovo Legion 7i Gen 10.webp",
                ],
                [
                    "name" => "Corsair One i500",
                    "price" => 45000,
                    "description" => "Liquid Cooled Intel Core i9-14900K and NVIDIA RTX 4090, 2TB M.2 SSD, 64GB DDR5, Win11 Pro",
                    "image" => "/Corsair One i500.avif",
                ],
            ],
            "Gaming Laptops" => [
                [
                    "name" => "Razer Blade 16",
                    "price" => 56000,
                    "description" => "Intel® Core™ Ultra 9 386H, NVIDIA® GeForce RTX™ 5090 Laptop GPU 24GB GDDR7, 16\" QHD+ 240Hz OLED, 64GB LPDDR5X, 2TB SSD",
                    "image" => "/Razer Blade 16.jpg",
                ],
                [
                    "name" => "Lenovo Legion Pro 7i Gen 10",
                    "price" => 52000,
                    "description" => "Intel® Core™ Ultra 9 275HX, Windows 11 Home, RTX™ 5090 24Go GDDR7, 64 Go DDR5-6400MT/s, 1To SSD Gen4, 16\" WQXGA OLED",
                    "image" => "/Lenovo Legion Pro 7i Gen 10.avif",
                ],
                [
                    "name" => "ASUS ROG Zephyrus G16",
                    "price" => 58000,
                    "description" => "Intel® Core™ Ultra 9 386H, RTX™ 5090 ROG Boost, 16\" 2.5K WQXGA OLED, 64GB LPDDR5X, 2TB PCIe 4.0 NVMe SSD",
                    "image" => "/ASUS ROG Zephyrus G16.webp",
                ],
                [
                    "name" => "Alienware 18 Area-51",
                    "price" => 42000,
                    "description" => "Intel® Core™ Ultra 9 275HX 24 cores, Windows 11 Home, RTX™ 5070 Ti, 64 GB DDR5, 2 TB Gen5 PCIe NVMe SSD, 18\" WQXGA",
                    "image" => "/Alienware 18 Area-51.avif",
                ],
                [
                    "name" => "MSI Vector 16 HX AI",
                    "price" => 24000,
                    "description" => "Intel Ultra 7 255HX, Windows 11 Home, NVIDIA RTX 5070 Ti 12GB, 16GB DDR5, 1TB SSD Gen5, 16\" QHD+ 240Hz",
                    "image" => "/MSI Vector 16 HX AI.jpg",
                ],
            ],
            "Gaming Chairs" => [
                [
                    "name" => "Secretlab Titan Evo",
                    "price" => 7000,
                    "description" => "Premium ergonomic gaming chair with adjustable lumbar support.",
                    "image" => "/Secretlab Titan Evo.jpg",
                ],
                [
                    "name" => "Razer Iskur",
                    "price" => 5500,
                    "description" => "Gaming chair with excellent posture support.",
                    "image" => "/Razer Iskur.jfif",
                ],
                [
                    "name" => "DXRacer Air",
                    "price" => 15000,
                    "description" => "Comfortable breathable gaming chair for long sessions.",
                    "image" => "/DXRacer Air.jpg",
                ],
                [
                    "name" => "AndaSeat Kaiser 3",
                    "price" => 4900,
                    "description" => "Luxury gaming chair with memory foam cushions.",
                    "image" => "/AndaSeat Kaiser 3.jpg",
                ],
                [
                    "name" => "Corsair TC100 Relaxed",
                    "price" => 3500,
                    "description" => "Affordable premium gaming chair with ergonomic design.",
                    "image" => "/Corsair TC100 Relaxed.jpg",
                ],
            ],
            "Gaming Monitors" => [
                [
                    "name" => "Samsung Odyssey G9",
                    "price" => 16000,
                    "description" => "Ultra-wide curved 49\" gaming monitor with 240Hz refresh rate.",
                    "image" => "/Samsung Odyssey G9.webp",
                ],
                [
                    "name" => "ASUS ROG Swift OLED",
                    "price" => 14000,
                    "description" => "OLED gaming monitor 27\" with 240Hz refresh rate and QHD resolution.",
                    "image" => "/ASUS ROG Swift OLED.jpg",
                ],
                [
                    "name" => "LG UltraGear 27",
                    "price" => 1900,
                    "description" => "Competitive 27\" gaming monitor with vibrant colors and 180Hz.",
                    "image" => "/LG UltraGear 27.jfif",
                ],
                [
                    "name" => "Alienware AW3423DWF",
                    "price" => 9000,
                    "description" => "Premium curved OLED 34\" gaming monitor, 165Hz refresh rate.",
                    "image" => "/Alienware AW3423DW.jfif",
                ],
                [
                    "name" => "MSI MPG 321URX",
                    "price" => 13000,
                    "description" => "4K 32\" gaming monitor, OLED display, 240Hz refresh rate.",
                    "image" => "/MSI MPG 321URX.jpg",
                ],
            ],
            "Gaming Keyboards" => [
                [
                    "name" => "SteelSeries Apex Pro",
                    "price" => 3300,
                    "description" => "Mechanical gaming keyboard with customizable switches.",
                    "image" => "/steelSeries Apex Pro.jpg",
                ],
                [
                    "name" => "Corsair K100 RGB",
                    "price" => 1500,
                    "description" => "Premium RGB gaming keyboard with fast optical switches.",
                    "image" => "/Corsair K100 RGB.jpg",
                ],
                [
                    "name" => "Razer Huntsman V3 Pro",
                    "price" => 2100,
                    "description" => "Fast esports keyboard with optical switches.",
                    "image" => "/Razer Huntsman V3 Pro.jpg",
                ],
                [
                    "name" => "Logitech G Pro X",
                    "price" => 1900,
                    "description" => "Compact gaming keyboard for competitive gamers.",
                    "image" => "/Logitech G Pro X.jpg",
                ],
                [
                    "name" => "HyperX Alloy Origins",
                    "price" => 1200,
                    "description" => "Solid aluminum gaming keyboard with RGB lighting.",
                    "image" => "/HyperX Alloy Origins.jpg",
                ],
            ],
            "Gaming Mice" => [
                [
                    "name" => "Logitech G Pro X Superlight 2",
                    "price" => 1900,
                    "description" => "60g ultralight wireless gaming mouse, HERO 2 sensor (32,000+ DPI), LIGHTFORCE hybrid switches, 8,000Hz polling rate, 95-hour battery.",
                    "image" => "/Logitech G Pro X Superlight 2.webp",
                ],
                [
                    "name" => "Logitech G502 HERO",
                    "price" => 450,
                    "description" => "Souris Gaming Filaire Haute Performance, Capteur Gaming HERO 25K, 25 600 PPP, RVB, Poids Ajustable, 11 Boutons Programmables, Mémoire Intégrée, PC/Mac",
                    "image" => "/Logitech G502 HERO.jpg",
                ],
                [
                    "name" => "Razer Viper V3 Pro",
                    "price" => 1900,
                    "description" => "~54g wireless symmetrical esports mouse, Focus Pro 35K Gen-2 sensor, Optical Switches Gen-3, 8000Hz polling rate.",
                    "image" => "/Razer Viper V3 Pro.jpg",
                ],
                [
                    "name" => "SteelSeries Aerox 5",
                    "price" => 1850,
                    "description" => "66-74g ultralight mouse, 9 programmable buttons, IP54 AquaBarrier, TrueMove Air sensor, 180-hour wireless battery.",
                    "image" => "/SteelSeries Aerox 5.avif",
                ],
                [
                    "name" => "Corsair Darkstar Wireless",
                    "price" => 1400,
                    "description" => "15-button MMO/MOBA wireless mouse, 6-button thumb cluster, 26,000 DPI optical sensor.",
                    "image" => "/Corsair Darkstar Wireless.jpg",
                ],
                [
                    "name" => "Glorious Model O 2",
                    "price" => 1100,
                    "description" => "59-68g ambidextrous mouse, BAMF 2.0 sensor (26000DPI), improved optical switches, RGB, wired & wireless.",
                    "image" => "/Glorious Model O 2.webp",
                ],
            ],
            "Gaming Headsets" => [
                [
                    "name" => "SteelSeries Arctis Nova Pro Wireless",
                    "price" => 4300,
                    "description" => "Premium wireless gaming headset with surround sound and noise cancellation.",
                    "image" => "/SteelSeries Arctis Nova Pro Wireless.jpg",
                ],
                [
                    "name" => "HyperX Cloud III",
                    "price" => 1190,
                    "description" => "Comfortable gaming headset with clear microphone and balanced sound.",
                    "image" => "/HyperX Cloud III.jpg",
                ],
                [
                    "name" => "Logitech G Pro X 2",
                    "price" => 2500,
                    "description" => "Professional esports headset with high quality audio.",
                    "image" => "/Logitech G Pro X 2.jpg",
                ],
                [
                    "name" => "Razer BlackShark V2 Pro",
                    "price" => 670,
                    "description" => "Wireless gaming headset optimized for competitive gaming.",
                    "image" => "/Razer BlackShark V2 Pro.jpg",
                ],
                [
                    "name" => "Corsair HS80 RGB",
                    "price" => 1700,
                    "description" => "RGB wireless headset with immersive Dolby Atmos sound.",
                    "image" => "/Corsair HS80 RGB.jpg",
                ],
            ],
            "Gaming Microphones" => [
                [
                    "name" => "HyperX QuadCast S",
                    "price" => 2100,
                    "description" => "RGB USB microphone designed for streamers and gamers.",
                    "image" => "/HyperX QuadCast S.jpg",
                ],
                [
                    "name" => "Blue Yeti X",
                    "price" => 2850,
                    "description" => "Professional USB microphone with excellent voice clarity.",
                    "image" => "/Blue Yeti X.jpg",
                ],
                [
                    "name" => "Razer Seiren V2 Pro",
                    "price" => 1840,
                    "description" => "Streaming microphone with studio-quality sound.",
                    "image" => "/Razer Seiren V2 Pro.jpg",
                ],
                [
                    "name" => "Elgato Wave 3",
                    "price" => 2250,
                    "description" => "Premium microphone with advanced streaming controls.",
                    "image" => "/Elgato Wave 3.jpg",
                ],
                [
                    "name" => "Shure MV7",
                    "price" => 6500,
                    "description" => "Hybrid USB/XLR microphone for professional streaming and podcasts.",
                    "image" => "/Shure MV7.jpg",
                ],
            ],
            "Gaming Consoles" => [
                [
                    "name" => "PlayStation 5",
                    "price" => 7199,
                    "description" => "Next-generation gaming console with exclusive games and fast SSD.",
                    "image" => "/ps5_console.png",
                ],
                [
                    "name" => "Xbox Series X",
                    "price" => 6100,
                    "description" => "Powerful Microsoft console designed for 4K gaming.",
                    "image" => "/xbox_console.png",
                ],
                [
                    "name" => "Nintendo Switch OLED",
                    "price" => 4500,
                    "description" => "Portable and home gaming console with OLED display.",
                    "image" => "/Nintendo Switch OLED.jfif",
                ],
                [
                    "name" => "Nintendo Switch 2",
                    "price" => 5500,
                    "description" => "Portable and home gaming console with OLED display.",
                    "image" => "/Nintendo Switch 2.webp",
                ],
                [
                    "name" => "PlayStation 5 Pro",
                    "price" => 8900,
                    "description" => "Latest PS5 with more powerful hardware than the base PS5.",
                    "image" => "/ps5 pro.webp",
                ],
                [
                    "name" => "Xbox Series S",
                    "price" => 3900,
                    "description" => "Compact affordable Xbox console for digital gaming.",
                    "image" => "/Xbox Series S.avif",
                ],
            ],
            "Gaming Controllers" => [
                [
                    "name" => "DualSense PS5 Controller",
                    "price" => 899,
                    "description" => "Official PlayStation controller with adaptive triggers and haptic feedback.",
                    "image" => "/DualSense PS5 Controller.jpg",
                ],
                [
                    "name" => "Xbox Wireless Controller",
                    "price" => 1150,
                    "description" => "Comfortable wireless controller compatible with Xbox and PC.",
                    "image" => "/Xbox Wireless Controller.avif",
                ],
                [
                    "name" => "SCUF Reflex Pro",
                    "price" => 2100,
                    "description" => "Professional esports controller with customizable paddles.",
                    "image" => "/SCUF Reflex Pro.webp",
                ],
                [
                    "name" => "Razer Wolverine V2 Pro",
                    "price" => 999,
                    "description" => "Premium gaming controller for competitive players.",
                    "image" => "/Razer Wolverine V2 Pro.webp",
                ],
                [
                    "name" => "8BitDo Ultimate Controller",
                    "price" => 876,
                    "description" => "Multi-platform wireless controller with charging dock.",
                    "image" => "/8BitDo Ultimate Controller.jpg",
                ],
            ],
            "Gaming Mousepads" => [
                [
                    "name" => "SteelSeries QcK XXL",
                    "price" => 430,
                    "description" => "Large gaming mousepad with smooth precision surface – 900×400×2 mm.",
                    "image" => "/SteelSeries QcK XXL.jfif",
                ],
                [
                    "name" => "Logitech G840 XL",
                    "price" => 489,
                    "description" => "Extended gaming mousepad for esports precision – 900×400×3 mm.",
                    "image" => "/Logitech G840 XL.jfif",
                ],
                [
                    "name" => "Razer Gigantus V2 3XL",
                    "price" => 699,
                    "description" => "Soft gaming mousepad with optimized tracking surface – 1200×550×4 mm.",
                    "image" => "/Razer Gigantus V2.jpg",
                ],
                [
                    "name" => "Corsair MM700 RGB",
                    "price" => 440,
                    "description" => "RGB gaming mousepad with large desk coverage – 930×400 mm, 4mm thick.",
                    "image" => "/Corsair MM700 RGB.avif",
                ],
                [
                    "name" => "Glorious 3XL Extended",
                    "price" => 600,
                    "description" => "Massive gaming mousepad for full setups – 610×1220×3 mm.",
                    "image" => "/Glorious 3XL Extended.png",
                ],
            ],
        ];

        foreach ($data as $catName => $products) {
            $category = Category::updateOrCreate(['name' => $catName]);
            foreach ($products as $p) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $p['name'],
                    'price' => $p['price'],
                    'description' => $p['description'],
                    'image' => $p['image'],
                    'stock' => rand(5, 50),
                ]);
            }
        }
    }
}
