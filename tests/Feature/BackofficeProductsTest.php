<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BackofficeProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set Up Function
     *
     * Runs before each test is executed
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /**
     * Test an authenticated user can add a product.
     *
     * @return void
     */
    public function test_authenticated_user_can_add_a_product()
    {
        $user = User::factory()->create();

        $mobilePhonesType = ProductType::factory()->create();

        $mainCategory = Category::factory()->create();

        $file = UploadedFile::fake()->image('test.jpg');

        $productData = [
            'productType' => $mobilePhonesType->id,
            'manufacturer' => 'Example Manufacturer',
            'model' => 'Example Model',
            'description' => 'Example description 123',
            'picture' => $file,
            'attributes' => '{"network": "unlocked", "colour": "red", "storage": "64gb"}',
            'condition' => 'new',
            'slug' => 'random-slug',
            'price' => 456,
            'mainCategory' => $mainCategory->id,
        ];

        $response = $this->actingAs($user)->json('POST', '/products', $productData);

        $response->assertStatus(201);

        $product = Product::where('slug', 'random-slug')->firstOrFail();

        // Product Exists
        $this->assertNotNull($product);

        // Manufacturer, Model, Description, Condiiton, Slug
        $this->assertDatabaseHas('products', array_filter($productData, function ($key) {
            return $key != 'productType'
                && $key != 'picture'
                && $key != 'attributes'
                && $key != 'price'
                && $key != 'mainCategory';
        }, ARRAY_FILTER_USE_KEY));

        // Product Type Id, Price
        $this->assertDatabaseHas('products', [
            'product_type_id' => $productData['productType'],
            'price' => (int) bcmul($productData['price'], 100.0),
        ]);

        // Picture
        $this->assertDatabaseCount('images', 1);
        $this->assertDatabaseHas('images', [
            'location' => 'images/' . $file->hashName(),
            'product_id' => $product->id,
        ]);

        // Category
        $this->assertTrue($product->categories()->first()->id === $productData['mainCategory']);

        // Attributes
        $this->assertJsonStringEqualsJsonString(
            json_encode($product->attributes),
            $productData['attributes']
        );

        // Main Category
        $this->assertTrue($product->categories()->first()->id === $productData['mainCategory']);

    }

    /**
     * Test to delete a product and its associated image from the database
     *
     * @return void
     */
    public function test_user_can_delete_product_and_image_from_database()
    {
        $user = User::factory()->create();

        $picture = UploadedFile::fake()->image('test.jpg');

        $product = Product::factory()->hasImages(1, ['location' => 'images/' . $picture->hashName()])->create();

        $response = $this->actingAs($user)->json('DELETE', '/products/' . $product->id);

        $response->assertRedirect(route('products.index'));

        $this->assertDeleted($product);

        $this->assertDatabaseMissing('images', [
            'location' => 'images/' . $picture->hashName(),
            'product_id' => $product->id,
        ]);

    }

    // Todo: update product
}
