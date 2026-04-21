<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@eraaz.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create Vendors
        $vendor1 = User::create([
            'name' => 'Tech Store',
            'email' => 'vendor@eraaz.com',
            'password' => bcrypt('password'),
            'role' => 'vendor',
        ]);

        $vendor2 = User::create([
            'name' => 'Fashion Hub',
            'email' => 'vendor2@eraaz.com',
            'password' => bcrypt('password'),
            'role' => 'vendor',
        ]);

        // Create Customer
        $customer = User::create([
            'name' => 'John Customer',
            'email' => 'customer@eraaz.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics', 'description' => 'Gadgets, phones, laptops and more'],
            ['name' => 'Fashion', 'slug' => 'fashion', 'description' => 'Clothing, shoes, and accessories'],
            ['name' => 'Home & Garden', 'slug' => 'home-garden', 'description' => 'Furniture, decor, and garden tools'],
            ['name' => 'Sports', 'slug' => 'sports', 'description' => 'Sports equipment and activewear'],
            ['name' => 'Books', 'slug' => 'books', 'description' => 'Books, eBooks, and audiobooks'],
            ['name' => 'Health & Beauty', 'slug' => 'health-beauty', 'description' => 'Skincare, wellness, and beauty products'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Products for Vendor 1 (Tech Store)
        $techProducts = [
            ['name' => 'Wireless Bluetooth Headphones', 'description' => 'Premium noise-cancelling wireless headphones with 30-hour battery life. Deep bass, crystal clear audio, and comfortable over-ear design.', 'price' => 79.99, 'stock' => 50, 'category_id' => 1],
            ['name' => 'USB-C Fast Charger 65W', 'description' => 'Ultra-compact 65W GaN charger compatible with laptops, tablets, and phones. Supports PD 3.0 and QC 4.0.', 'price' => 34.99, 'stock' => 100, 'category_id' => 1],
            ['name' => 'Mechanical Gaming Keyboard', 'description' => 'RGB backlit mechanical keyboard with Cherry MX switches. Full N-key rollover and aluminum frame construction.', 'price' => 129.99, 'stock' => 30, 'category_id' => 1],
            ['name' => 'Smart Fitness Watch', 'description' => 'Waterproof smartwatch with heart rate monitor, GPS tracking, sleep analysis, and 7-day battery life.', 'price' => 149.99, 'stock' => 40, 'category_id' => 1],
            ['name' => 'Portable Bluetooth Speaker', 'description' => '360° surround sound portable speaker. Waterproof, dustproof, and 12-hour playtime.', 'price' => 49.99, 'stock' => 70, 'category_id' => 1],
            ['name' => 'Programming Mastery Book', 'description' => 'Complete guide to modern web development covering Laravel, React, and database design.', 'price' => 29.99, 'stock' => 200, 'category_id' => 5],
        ];

        foreach ($techProducts as $product) {
            Product::create(array_merge($product, [
                'slug' => Str::slug($product['name']) . '-' . Str::random(5),
                'vendor_id' => $vendor1->id,
                'is_active' => true,
            ]));
        }

        // Create Products for Vendor 2 (Fashion Hub)
        $fashionProducts = [
            ['name' => 'Premium Cotton T-Shirt', 'description' => 'Ultra-soft 100% organic cotton t-shirt. Available in multiple colors. Perfect for everyday wear.', 'price' => 24.99, 'stock' => 150, 'category_id' => 2],
            ['name' => 'Running Sneakers Pro', 'description' => 'Lightweight running shoes with advanced cushioning technology. Breathable mesh upper and responsive sole.', 'price' => 89.99, 'stock' => 60, 'category_id' => 4],
            ['name' => 'Leather Crossbody Bag', 'description' => 'Handcrafted genuine leather crossbody bag with adjustable strap. Multiple compartments for organization.', 'price' => 59.99, 'stock' => 35, 'category_id' => 2],
            ['name' => 'Yoga Mat Premium', 'description' => 'Eco-friendly non-slip yoga mat. 6mm thickness for joint protection. Includes carrying strap.', 'price' => 39.99, 'stock' => 80, 'category_id' => 4],
            ['name' => 'Aromatherapy Essential Oil Set', 'description' => '6-pack pure essential oils including lavender, peppermint, tea tree, eucalyptus, orange, and lemongrass.', 'price' => 27.99, 'stock' => 120, 'category_id' => 6],
            ['name' => 'Modern Desk Lamp LED', 'description' => 'Minimalist LED desk lamp with 5 brightness levels, USB charging port, and eye protection technology.', 'price' => 44.99, 'stock' => 45, 'category_id' => 3],
        ];

        foreach ($fashionProducts as $product) {
            Product::create(array_merge($product, [
                'slug' => Str::slug($product['name']) . '-' . Str::random(5),
                'vendor_id' => $vendor2->id,
                'is_active' => true,
            ]));
        }

        echo "\n✅ Database seeded successfully!\n";
        echo "📧 Admin:    admin@eraaz.com / password\n";
        echo "📧 Vendor 1: vendor@eraaz.com / password\n";
        echo "📧 Vendor 2: vendor2@eraaz.com / password\n";
        echo "📧 Customer: customer@eraaz.com / password\n";
    }
}
