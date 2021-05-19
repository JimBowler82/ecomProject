<?php

namespace Database\Seeders;

use App\Models\Category;
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
                                'name' => 'New Samsung',
                                'slug' => 'new-samsung',
                            ],
                            [
                                'name' => 'New iPhones',
                                'slug' => 'new-iPhones',
                            ],
                            [
                                'name' => 'New Huawei',
                                'slug' => 'new-huawei',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Refurbished Phones',
                        'slug' => 'refurbished-phones',
                        'children' => [
                            [
                                'name' => 'Refurbished Samsung',
                                'slug' => 'refurbished-samsung',
                            ],
                            [
                                'name' => 'Refurbished IPhones',
                                'slug' => 'refurbished-iPhones',
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
                                'name' => 'New Samsung Headphones',
                                'slug' => 'new-samsung-headphones',
                            ],
                            [
                                'name' => 'New Apple Headphones',
                                'slug' => 'new-apple-headphones',
                            ],
                        ],
                    ],
                    [
                        'name' => 'Used Headphones',
                        'slug' => 'used-headphones',
                        'children' => [
                            [
                                'name' => 'Refurbished Samsung Headphones',
                                'slug' => 'refurbished-samsung-headphones',
                            ],
                            [
                                'name' => 'Refurbished Apple ',
                                'slug' => 'refurbished-apple-headphones',
                            ],
                        ],
                    ]
                ],
            ],
        ];
           

      
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
