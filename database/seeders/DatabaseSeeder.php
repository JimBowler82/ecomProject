<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $apple = Category::factory()->create([
            'name' => 'Apple',
            'slug' => 'apple'
        ]);

        $samsung = Category::factory()->create([
            'name' => 'Samsung',
            'slug' => 'samsung'
        ]);

        Category::factory()->create([
            'name' => 'Android',
            'slug' => 'android'
        ]);

        Category::factory()->create([
            'name' => 'Other',
            'slug' => 'other'
        ]);

        $new = Category::factory()->create([
            'name' => 'New Phones',
            'slug' => 'new-phones'
        ]);

        $refurb = Category::factory()->create([
            'name' => 'Refurbished Phones',
            'slug' => 'refurbished-phones'
        ]);

        Product::factory(10)->hasAttached([$apple, $new])->create([
            'manufacturer' => "Apple",
            'model' => "IPhone",
            'picture' => "images/iphone_placeholder.webp",
        ]);

        Product::factory(10)->hasAttached([$samsung, $new])->create([
            'manufacturer' => "Samsung",
            'model' => "Galaxy S20",
            'picture' => "images/samsung_placeholder.webp",
        ]);
    }
}
