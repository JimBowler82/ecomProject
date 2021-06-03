<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticatedRoutesTest extends TestCase
{
    use RefreshDatabase;

    private $endpoints = [
        '/backoffice',
        '/productTypes',
        '/productTypes/create',
        '/products',
        '/products/create',
        '/categories',
        '/categories/create',
        '/orders',
    ];

    public function test_authenticated_user_can_access_authenticated_routes()
    {
        $user = User::factory()->create();

        foreach ($this->endpoints as $endpoint) {
            $response = $this->actingAs($user)->get(env('APP_URL') . $endpoint);
            $response->assertStatus(200);
        }

    }

    public function test_guests_cannot_access_authenticated_routes()
    {
        foreach ($this->endpoints as $endpoint) {
            $response = $this->get(env('APP_URL') . $endpoint);
            $response->assertStatus(302);
            $response->assertLocation('/login');
        }

    }
}
