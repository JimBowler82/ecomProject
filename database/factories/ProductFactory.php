<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductType;
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
            'product_type_id' => ProductType::factory(),
            'manufacturer' => "Example Manufacturer",
            'model' => "Example 123",
            'condition' => 'new',
            'description' => $this->faker->sentences($nb = 2, $asText = true),
            'attributes' => json_decode('{"network": "unlocked", "colour": "red", "storage": "64gb"}'),
            'slug' => $this->faker->slug(),
            'price' => $this->faker->numberBetween($min = 8999, $max = 120000),
        ];
    }
}
