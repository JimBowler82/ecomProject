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
        // Categories

        $this->call([CategorySeeder::class]);
        

        // Product Types

        $mobilePhones = ProductType::factory()->create([
            'name' => 'Mobile Phones',
            'slug' => 'mobile-phones',
            
        ]);

        $headPhones = ProductType::factory()->create([
            'name' => 'Headphones',
            'slug' => 'headphones',
        ]);

        $accessories = ProductType::factory()->create([
            'name' => 'Accessories',
            'slug' => 'accessories',
        ]);


        // Products

        Product::factory(10)->hasAttached(Category::find(4))->hasImages(1, [
            'location' => 'images/iphone_placeholder.webp',
        ])->create([
            'manufacturer' => "Apple",
            'model' => "IPhone 12",
            'condition' => 'new',
            'product_type_id' => $mobilePhones->id,
        ]);

        Product::factory(10)->hasAttached(Category::find(8))->hasImages(1, [
            'location' => 'images/iphone_placeholder.webp',
        ])->create([
            'manufacturer' => "Apple",
            'model' => "IPhone 12",
            'condition' => 'refurbished',
            'product_type_id' => $mobilePhones->id,
        ]);

        Product::factory(10)->hasAttached(Category::find(3))->hasImages(1, [
            'location' => 'images/samsung_placeholder.webp',
        ])->create([
            'manufacturer' => "Samsung",
            'model' => "Galaxy S20",
            'condition' => 'new',
            'product_type_id' => $mobilePhones->id,
        ]);

        Product::factory(10)->hasAttached(Category::find(7))->hasImages(1, [
            'location' => 'images/samsung_placeholder.webp',
        ])->create([
            'manufacturer' => "Samsung",
            'model' => "Galaxy S20",
            'condition' => 'refurbished',
            'product_type_id' => $mobilePhones->id,
        ]);

        Product::factory(10)->hasAttached(Category::find(5))->hasImages(1, [
            'location' => 'images/huawei_placeholder.webp',
        ])->create([
            'manufacturer' => "Huawei",
            'model' => "GP30 Lite",
            'condition' => 'new',
            'product_type_id' => $mobilePhones->id,
        ]);
    }
}
