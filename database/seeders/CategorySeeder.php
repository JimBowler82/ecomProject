<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Mobile Phones',
                'slug' => 'mobile-phones',
                'children' => [
                    [
                        'name' => 'New Phones',
                        'slug' => 'new-phones',
                        'children' => [
                            [
                                'name' => 'Samsung',
                                'slug' => 'samsung',
                            ],
                            [
                                'name' => 'iPhones',
                                'slug' => 'iPhones',
                            ],
                            [
                                'name' => 'Huawei',
                                'slug' => 'huawei',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Refurbished Phones',
                        'slug' => 'refurbished-phones',
                        'children' => [
                            [
                                'name' => 'Samsung',
                                'slug' => 'samsung',
                            ],
                            [
                                'name' => 'IPhones',
                                'slug' => 'iPhones',
                            ],
                        ],
                    ],
                ],
            ],
           
            [
                'name' => 'Headphones',
                'slug' => 'headphones',
                'children' => [
                    [
                        'name' => 'New Headphones',
                        'slug' => 'new-headphones',
                        'children' => [
                            [
                                'name' => 'Samsung Headphones',
                                'slug' => 'samsung-headphones',
                            ],
                            [
                                'name' => 'Apple Headphones',
                                'slug' => 'apple-headphones',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Used Headphones',
                        'slug' => 'used-headphones',
                        'children' => [
                            [
                                'name' => 'Samsung Headphones',
                                'slug' => 'samsung-headphones',
                            ],
                            [
                                'name' => 'Apple ',
                                'slug' => 'apple-headphones',
                            ],
                        ],
                    ]
                ],
            ],
        ];
           

      
        foreach ($categories as $category) {
            $newCategory = Category::create($category);

            if ($newCategory->slug === 'mobile-phones') {
                $image = Image::create(['location' => 'images/new_phones.webp']);
            } else {
                $image = Image::create(['location' => 'images/headphones.webp']);
            }

            $newCategory->image()->save($image);
        }
    }
}
