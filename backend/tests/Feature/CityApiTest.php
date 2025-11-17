<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\County;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CityApiTest extends TestCase
{
    use RefreshDatabase;

    // ----------------------------------------
    // INDEX TESTS
    // ----------------------------------------

    #[Test]
    public function guest_can_list_all_cities()
    {
        $county = County::factory()->create();
        City::factory()->count(3)->create(['county_id' => $county->id]);

        $response = $this->getJson('/api/city');

        $response->assertOk()
                 ->assertJsonCount(3, 'cities');
    }

    #[Test]
    public function guest_can_list_cities_by_county()
    {
        $county = County::factory()->create();
        City::factory()->count(2)->create(['county_id' => $county->id]);

        $response = $this->getJson("/api/county/{$county->id}/city");

        $response->assertOk()
                 ->assertJsonCount(2, 'cities');
    }

    #[Test]
    public function guest_can_list_city_initials_by_county()
    {
        $county = County::factory()->create();
        City::factory()->create(['name' => 'Amsterdam', 'county_id' => $county->id]);
        City::factory()->create(['name' => 'Berlin', 'county_id' => $county->id]);

        $response = $this->getJson("/api/county/{$county->id}/abc");

        $response->assertOk()
                 ->assertJsonFragment(['initials' => ['A', 'B']]);
    }

    #[Test]
    public function guest_can_list_cities_by_initial_in_county()
    {
        $county = County::factory()->create();
        City::factory()->create(['name' => 'Amsterdam', 'county_id' => $county->id]);
        City::factory()->create(['name' => 'Arnhem', 'county_id' => $county->id]);
        City::factory()->create(['name' => 'Berlin', 'county_id' => $county->id]);

        $response = $this->getJson("/api/county/{$county->id}/abc/A");

        $response->assertOk()
                 ->assertJsonCount(2, 'cities')
                 ->assertJsonFragment(['name' => 'Amsterdam']);
    }

    // ----------------------------------------
    // SHOW TESTS
    // ----------------------------------------

    #[Test]
    public function guest_can_view_a_city()
    {
        $county = County::factory()->create();
        $city = City::factory()->create(['county_id' => $county->id]);

        $response = $this->getJson("/api/city/{$city->id}");

        $response->assertOk()
                 ->assertJsonPath('city.id', $city->id);
    }

    #[Test]
    public function guest_can_view_a_city_by_county()
    {
        $county = County::factory()->create();
        $city = City::factory()->create(['county_id' => $county->id]);

        $response = $this->getJson("/api/county/{$county->id}/city/{$city->id}");

        $response->assertOk()
                 ->assertJsonPath('city.id', $city->id);
    }

    // ----------------------------------------
    // AUTHENTICATED (CREATE / UPDATE / DELETE)
    // ----------------------------------------

    #[Test]
    public function authenticated_user_can_create_city()
    {
        $user = User::factory()->create();
        $county = County::factory()->create();

        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/city', [
            'name' => 'New City',
            'county_id' => $county->id,
        ]);

        $response->assertOk()
                 ->assertJsonPath('city.name', 'New City');
        $this->assertDatabaseHas('cities', ['name' => 'New City']);
    }

    #[Test]
    public function authenticated_user_can_update_city()
    {
        $user = User::factory()->create();
        $county = County::factory()->create();
        $city = City::factory()->create(['name' => 'Old City', 'county_id' => $county->id]);

        $this->actingAs($user, 'sanctum');

        $response = $this->patchJson("/api/city/{$city->id}", [
            'name' => 'Updated City'
        ]);

        $response->assertOk()
                 ->assertJsonPath('city.name', 'Updated City');
        $this->assertDatabaseHas('cities', ['name' => 'Updated City']);
    }

    #[Test]
    public function authenticated_user_can_delete_city()
    {
        $user = User::factory()->create();
        $county = County::factory()->create();
        $city = City::factory()->create(['county_id' => $county->id]);

        $this->actingAs($user, 'sanctum');

        $response = $this->deleteJson("/api/city/{$city->id}");

        $response->assertOk()
                 ->assertJsonPath('message', 'City deleted successfully');
        $this->assertDatabaseMissing('cities', ['id' => $city->id]);
    }

    // ----------------------------------------
    // GUEST RESTRICTIONS
    // ----------------------------------------

    #[Test]
    public function guest_cannot_create_update_or_delete_city()
    {
        $county = County::factory()->create();
        $city = City::factory()->create(['county_id' => $county->id]);

        $this->postJson('/api/city', ['name' => 'Unauthorized City', 'county_id' => $county->id])
             ->assertUnauthorized();

        $this->patchJson("/api/city/{$city->id}", ['name' => 'City'])
             ->assertUnauthorized();

        $this->deleteJson("/api/city/{$city->id}")
             ->assertUnauthorized();
    }
}
