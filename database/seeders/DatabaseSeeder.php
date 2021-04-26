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

        $android = Category::factory()->create([
            'name' => 'Android',
            'slug' => 'android'
        ]);

        $other = Category::factory()->create([
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
            'model' => "IPhone 12",
            'condition' => 'new',
            'picture' => "images/iphone_placeholder.webp",
        ]);

        Product::factory(10)->hasAttached([$apple, $refurb])->create([
            'manufacturer' => "Apple",
            'model' => "IPhone 12",
            'condition' => 'refurbished',
            'picture' => "images/iphone_placeholder.webp",
        ]);

        Product::factory(10)->hasAttached([$samsung, $android, $new])->create([
            'manufacturer' => "Samsung",
            'model' => "Galaxy S20",
            'condition' => 'new',
            'picture' => "images/samsung_placeholder.webp",
        ]);

        Product::factory(10)->hasAttached([$samsung, $android, $refurb])->create([
            'manufacturer' => "Samsung",
            'model' => "Galaxy S20",
            'condition' => 'refurbished',
            'picture' => "images/samsung_placeholder.webp",
        ]);

        Product::factory(10)->hasAttached([$other, $android, $new])->create([
            'manufacturer' => "Huawei",
            'model' => "GP30 Lite",
            'condition' => 'new',
            'picture' => "images/huawei_placeholder.webp",
        ]);
    }
}
