<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $user = User::factory(['store_id' => 1])->create();
        Store::factory()->create();

        // Act as that user
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }
}
