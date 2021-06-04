<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BackofficeCategoryTest extends TestCase
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
     * Test an authenticated user can add a root category with a picture
     *
     * @return void
     */
    public function test_authenticated_user_can_add_a_root_category_with_a_picture()
    {
        $user = User::factory()->create();

        $picture = UploadedFile::fake()->image('test.jpg');

        $categoryData = [
            'name' => 'Example Category',
            'slug' => 'example-category',
            'operator' => 'root',
            'picture' => $picture,
        ];

        $response = $this->actingAs($user)->json('POST', '/categories', $categoryData);

        $response->assertRedirect('/categories');

        $category = Category::where('slug', 'example-category')->firstOrFail();

        // Category Exists
        $this->assertNotNull($category);

        // Database entry is correct
        $this->assertDatabaseHas('categories', [
            'name' => 'Example Category',
            'slug' => 'example-category',
            'parent_id' => null,
        ]);

        // Picture
        $this->assertDatabaseCount('images', 1);
        $this->assertDatabaseHas('images', [
            'location' => 'images/' . $picture->hashName(),
            'category_id' => $category->id,
        ]);

        // Category is a root node
        $this->assertTrue($category->isRoot());
    }

    /**
     * Test an authenticated user can add a nested category with a picture
     *
     * @return void
     */
    public function test_authenticated_user_can_add_a_nested_category_with_a_picture()
    {
        $user = User::factory()->create();

        $picture = UploadedFile::fake()->image('test.jpg');

        $parentCategory = Category::factory()->create();

        $categoryData = [
            'name' => 'Example Category',
            'slug' => 'example-category',
            'operator' => 'after',
            'picture' => $picture,
            'existingCategory' => $parentCategory->id,
        ];

        $response = $this->actingAs($user)->json('POST', '/categories', $categoryData);

        $response->assertRedirect('/categories');

        $nestedCategory = Category::where('slug', 'example-category')->firstOrFail();

        // Category Exists
        $this->assertNotNull($nestedCategory);

        // Database entry is correct
        $this->assertDatabaseHas('categories', [
            'name' => 'Example Category',
            'slug' => 'example-category',
            'parent_id' => $parentCategory->id,
        ]);

        // Picture
        $this->assertDatabaseCount('images', 1);
        $this->assertDatabaseHas('images', [
            'location' => 'images/' . $picture->hashName(),
            'category_id' => $nestedCategory->id,
        ]);

        // Category is a root node
        $this->assertTrue($nestedCategory->isChildOf($parentCategory));
    }

    /**
     * Test an authenticated user can add a root category with a picture
     *
     * @return void
     */
    public function test_authenticated_user_can_add_a_root_category_without_picture()
    {
        $user = User::factory()->create();

        $categoryData = [
            'name' => 'Example Category',
            'slug' => 'example-category',
            'operator' => 'root',
        ];

        $response = $this->actingAs($user)->json('POST', '/categories', $categoryData);

        $response->assertRedirect('/categories');

        $category = Category::where('slug', 'example-category')->firstOrFail();

        // Category Exists
        $this->assertNotNull($category);

        // Database entry is correct
        $this->assertDatabaseHas('categories', [
            'name' => 'Example Category',
            'slug' => 'example-category',
            'parent_id' => null,
        ]);

        // Category is a root node
        $this->assertTrue($category->isRoot());
    }

    public function test_authenticated_user_can_add_a_nested_category_without_picture()
    {
        $user = User::factory()->create();

        $parentCategory = Category::factory()->create();

        $categoryData = [
            'name' => 'Example Category',
            'slug' => 'example-category',
            'operator' => 'after',
            'existingCategory' => $parentCategory->id,
        ];

        $response = $this->actingAs($user)->json('POST', '/categories', $categoryData);

        $response->assertRedirect('/categories');

        $nestedCategory = Category::where('slug', 'example-category')->firstOrFail();

        // Category Exists
        $this->assertNotNull($nestedCategory);

        // Database entry is correct
        $this->assertDatabaseHas('categories', [
            'name' => 'Example Category',
            'slug' => 'example-category',
            'parent_id' => $parentCategory->id,
        ]);

        // Category is a root node
        $this->assertTrue($nestedCategory->isChildOf($parentCategory));
    }

    /**
     * Test to delete a category and its associated image from the database
     *
     * @return void
     */
    public function test_user_can_delete_category_and_image_from_database()
    {
        $user = User::factory()->create();

        $picture = UploadedFile::fake()->image('test.jpg');

        $category = Category::factory()->hasImage(1, [
            'location' => 'images/' . $picture->hashName(),
        ])->create();

        $response = $this->actingAs($user)->json('DELETE', '/categories/' . $category->id);

        $response->assertRedirect(route('categories.index'));

        $this->assertDeleted($category);

        $this->assertDatabaseMissing('images', [
            'location' => 'images/' . $picture->hashName(),
            'product_id' => $category->id,
        ]);
    }

    // Todo: update category
}
