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
            'product_type_id' => '',
            'manufacturer' => "Apple",
            'model' => "IPhone",
            'condition' => 'new',
            'description' => $this->faker->sentences($nb=2, $asText = true),
            'attributes' => json_decode('{"size": "large", "colour": "red", "random": "true"}'),
            'price' => $this->faker->numberBetween($min = 8999, $max = 120000),
        ];
    }
}
