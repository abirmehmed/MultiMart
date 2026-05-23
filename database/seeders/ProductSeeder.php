<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'vendor_id' => 1,
            'category_id' => 1,
            'name' => 'Smartphone X',
            'slug' => 'smartphone-x',
            'description' => 'Latest model with 128GB storage.',
            'price' => 599.99,
            'stock' => 10,
            'sku' => 'SPH-X-001',
            'featured_image' => 'placeholder.jpg',
            'is_active' => true,
        ]);

        Product::create([
            'vendor_id' => 1,
            'category_id' => 2,
            'name' => 'Cotton T-Shirt',
            'slug' => 'cotton-t-shirt',
            'description' => 'Comfortable 100% cotton.',
            'price' => 19.99,
            'stock' => 50,
            'sku' => 'CTS-001',
            'featured_image' => 'placeholder.jpg',
            'is_active' => true,
        ]);
    }
}