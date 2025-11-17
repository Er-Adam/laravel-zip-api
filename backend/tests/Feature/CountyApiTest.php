<?php

namespace Tests\Feature;

use App\Models\County;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CountyApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function guest_can_list_counties()
    {
        County::factory()->count(3)->create();

        $response = $this->getJson('/api/county');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'counties');
    }

    #[Test]
    public function guest_can_view_a_single_county()
    {
        $county = County::factory()->create(['name' => 'Evergreen']);

        $response = $this->getJson("/api/county/{$county->id}");

        $response->assertStatus(200)
            ->assertJson([
                'county' => [
                    'id' => $county->id,
                    'name' => 'Evergreen',
                ]
            ]);
    }

    #[Test]
    public function guest_cannot_create_a_county()
    {
        $response = $this->postJson('/api/county', [
            'name' => 'Unauthorized County'
        ]);

        $response->assertStatus(401); // Unauthenticated
    }

    #[Test]
    public function authenticated_user_can_create_a_county()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/county', [
            'name' => 'New County'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'New County']);

        $this->assertDatabaseHas('counties', ['name' => 'New County']);
    }

    #[Test]
    public function guest_cannot_update_a_county()
    {
        $response = $this->patchJson('/api/county/1', [
            'name' => 'Unauthorized County'
        ]);

        $response->assertStatus(401);
    }

    #[Test]
    public function authenticated_user_can_update_a_county()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $county = County::factory()->create(['name' => 'Old Name']);

        $response = $this->patchJson("/api/county/{$county->id}", [
            'name' => 'Updated County'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated County']);

        $this->assertDatabaseHas('counties', ['name' => 'Updated County']);
    }

    #[Test]
    public function guest_cannot_delete_a_county()
    {
        $response = $this->deleteJson('/api/county/1');

        $response->assertStatus(401);
    }

    #[Test]
    public function authenticated_user_can_delete_a_county()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $county = County::factory()->create();

        $response = $this->deleteJson("/api/county/{$county->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'County deleted successfully']);

        $this->assertDatabaseMissing('counties', ['id' => $county->id]);
    }
}
