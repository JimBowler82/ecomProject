<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
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


        Product::factory(10)->hasAttached([$apple, $new,])->hasImages(1, [
            'location' => 'images/iphone_placeholder.webp',
        ])->create([
            'manufacturer' => "Apple",
            'model' => "IPhone 12",
            'condition' => 'new',
        ]);

        Product::factory(10)->hasAttached([$apple, $refurb,])->hasImages(1, [
            'location' => 'images/iphone_placeholder.webp',
        ])->create([
            'manufacturer' => "Apple",
            'model' => "IPhone 12",
            'condition' => 'refurbished',
        ]);

        Product::factory(10)->hasAttached([$samsung, $android, $new])->hasImages(1, [
            'location' => 'images/samsung_placeholder.webp',
        ])->create([
            'manufacturer' => "Samsung",
            'model' => "Galaxy S20",
            'condition' => 'new',
        ]);

        Product::factory(10)->hasAttached([$samsung, $android, $refurb])->hasImages(1, [
            'location' => 'images/samsung_placeholder.webp',
        ])->create([
            'manufacturer' => "Samsung",
            'model' => "Galaxy S20",
            'condition' => 'refurbished',
        ]);

        $product = Product::factory(10)->hasAttached([$other, $android, $new])->hasImages(1, [
            'location' => 'images/huawei_placeholder.webp',
        ])->create([
            'manufacturer' => "Huawei",
            'model' => "GP30 Lite",
            'condition' => 'new',
        ]);
    }
}
