<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'manufacturer' => "Apple",
            'model' => "IPhone",
            'condition' => 'new',
            'picture' => "images/dummy_phone.webp",
            'description' => $this->faker->sentences($nb=2, $asText = true),
            'price' => $this->faker->numberBetween($min = 8999, $max = 120000),
        ];
    }
}
