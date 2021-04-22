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
            'picture' => "images/dummy_phone.webp",
            'description' => $this->faker->text($maxNbChars = 50),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 450, $max = 1200),
        ];
    }
}
