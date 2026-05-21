<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Home & Garden', 'slug' => 'home-garden'],
            ['name' => 'Books', 'slug' => 'books'],
            ['name' => 'Sports', 'slug' => 'sports'],
            ['name' => 'Toys', 'slug' => 'toys'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}