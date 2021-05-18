<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductType;
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
        // // Categories

        // $apple = Category::factory()->create([
        //     'name' => 'Apple',
        //     'slug' => 'apple'
        // ]);

        // $samsung = Category::factory()->create([
        //     'name' => 'Samsung',
        //     'slug' => 'samsung'
        // ]);

        // $android = Category::factory()->create([
        //     'name' => 'Android',
        //     'slug' => 'android'
        // ]);

        // $other = Category::factory()->create([
        //     'name' => 'Other',
        //     'slug' => 'other'
        // ]);

        $this->call([CategorySeeder::class]);
        

        // Product Types

        $newPhones = ProductType::factory()->hasImage(1, [
            'location' => 'images/new_phones.webp'
        ])->create([
            'name' => 'New Phones',
            'slug' => 'new-phones',
            
        ]);

        $refurbPhones = ProductType::factory()->hasImage(1, [
            'location' => 'images/refurb_phones.webp'
        ])->create([
            'name' => 'Refurbished Phones',
            'slug' => 'refurbished-phones',
        ]);

        $usedPhones = ProductType::factory()->hasImage(1, [
            'location' => 'images/dummy_phone.webp'
        ])->create([
            'name' => 'Used Phones',
            'slug' => 'used-phones',
        ]);

        // Products

        

        Product::factory(10)->hasAttached(Category::findMany([1,2,4]))->hasImages(1, [
            'location' => 'images/iphone_placeholder.webp',
        ])->create([
            'manufacturer' => "Apple",
            'model' => "IPhone 12",
            'condition' => 'new',
            'product_type_id' => $newPhones->id,
        ]);

        Product::factory(10)->hasAttached(Category::findMany([1,5,7]))->hasImages(1, [
            'location' => 'images/iphone_placeholder.webp',
        ])->create([
            'manufacturer' => "Apple",
            'model' => "IPhone 12",
            'condition' => 'refurbished',
            'product_type_id' => $refurbPhones->id,
        ]);

        Product::factory(10)->hasAttached(Category::findMany([1,2,3]))->hasImages(1, [
            'location' => 'images/samsung_placeholder.webp',
        ])->create([
            'manufacturer' => "Samsung",
            'model' => "Galaxy S20",
            'condition' => 'new',
            'product_type_id' => $newPhones->id,
        ]);

        Product::factory(10)->hasAttached(Category::findMany([1,5,6]))->hasImages(1, [
            'location' => 'images/samsung_placeholder.webp',
        ])->create([
            'manufacturer' => "Samsung",
            'model' => "Galaxy S20",
            'condition' => 'refurbished',
            'product_type_id' => $refurbPhones->id,
        ]);

        Product::factory(10)->hasAttached(Category::findMany([1,2]))->hasImages(1, [
            'location' => 'images/huawei_placeholder.webp',
        ])->create([
            'manufacturer' => "Huawei",
            'model' => "GP30 Lite",
            'condition' => 'new',
            'product_type_id' => $newPhones->id,
        ]);
    }
}
