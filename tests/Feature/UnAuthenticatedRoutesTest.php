<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnAuthenticatedRoutesTest extends TestCase
{
    use RefreshDatabase;

    private $endpoints = [
        '/',
        '/cart',
        '/products',
    ];

    public function test_guest_can_view_unauthenticated_routes()
    {
        $product = Product::factory()->hasImages(1, ['location' => 'images/iphone_placeholder.webp'])->create();

        foreach ($this->endpoints as $endpoint) {
            if ($endpoint === '/products') {
                $response = $this->get(env('APP_URL') . $endpoint . '/' . $product->slug);
            } else {
                $response = $this->get(env('APP_URL') . $endpoint);
            }

            $response->assertStatus(200);
        }
    }
}
