<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\County;
use App\Models\PostalCode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PostalCodeApiTest extends TestCase
{
    use RefreshDatabase;

    // ----------------------------------------
    // INDEX TESTS
    // ----------------------------------------

    #[Test]
    public function guest_can_list_all_postalcodes()
    {
        $county = County::factory()->create();
        $city = City::factory()->create(['county_id' => $county->id]);
        PostalCode::factory()->count(3)->create(['city_id' => $city->id]);

        $response = $this->getJson('/api/postalcode');
        $response->assertOk()
                 ->assertJsonCount(3, 'postalCodes');
    }

    #[Test]
    public function guest_can_list_postalcodes_by_city_and_county()
    {
        $county = County::factory()->create();
        $city = City::factory()->create(['county_id' => $county->id]);
        PostalCode::factory()->count(2)->create(['city_id' => $city->id]);

        $response = $this->getJson("/api/county/{$county->id}/city/{$city->id}/postalcode");
        $response->assertOk()
                 ->assertJsonCount(2, 'postalcodes');
    }

    // ----------------------------------------
    // SHOW TESTS
    // ----------------------------------------

    #[Test]
    public function guest_can_view_a_postalcode()
    {
        $county = County::factory()->create();
        $city = City::factory()->create(['county_id' => $county->id]);
        $postalcode = PostalCode::factory()->create(['city_id' => $city->id]);

        $response = $this->getJson("/api/postalcode/{$postalcode->id}");
        $response->assertOk()
                 ->assertJsonPath('postalcode.id', $postalcode->id);
    }

    #[Test]
    public function guest_can_view_a_postalcode_by_city_and_county()
    {
        $county = County::factory()->create();
        $city = City::factory()->create(['county_id' => $county->id]);
        $postalcode = PostalCode::factory()->create(['city_id' => $city->id]);

        $response = $this->getJson("/api/county/{$county->id}/city/{$city->id}/postalcode/{$postalcode->id}");

        $response->assertOk()
                 ->assertJsonPath('postalcode.id', $postalcode->id);
    }

    // ----------------------------------------
    // AUTHENTICATED (CREATE / UPDATE / DELETE)
    // ----------------------------------------

    #[Test]
    public function authenticated_user_can_create_postalcode()
    {
        $user = User::factory()->create();
        $county = County::factory()->create();
        $city = City::factory()->create(['county_id' => $county->id]);

        $this->actingAs($user, 'sanctum');

        $postalCode = fake()->numberBetween(1, 99999);

        $response = $this->postJson('/api/postalcode', [
            'postal_code' => $postalCode,
            'city_id' => $city->id,
        ]);

        $response->assertOk()
                 ->assertJsonPath('postalcode.postal_code', $postalCode);
        $this->assertDatabaseHas('postal_codes', ['postal_code' => $postalCode]);
    }

    #[Test]
    public function authenticated_user_can_update_postalcode()
    {
        $originalPostalCode = fake()->numberBetween(1, 99999);
        $newPostalCode = $originalPostalCode + 1;

        $user = User::factory()->create();
        $county = County::factory()->create();
        $city = City::factory()->create(['county_id' => $county->id]);
        $postalcode = PostalCode::factory()->create(['city_id' => $city->id, 'postal_code' => $originalPostalCode]);

        $this->actingAs($user, 'sanctum');

        $response = $this->patchJson("/api/postalcode/{$postalcode->id}", [
            'postal_code' => $newPostalCode,
        ]);

        $response->assertOk()
                 ->assertJsonPath('postalcode.postal_code', $newPostalCode);
        $this->assertDatabaseHas('postal_codes', ['postal_code' => $newPostalCode]);
    }

    #[Test]
    public function authenticated_user_can_delete_postalcode()
    {
        $user = User::factory()->create();
        $county = County::factory()->create();
        $city = City::factory()->create(['county_id' => $county->id]);
        $postalcode = PostalCode::factory()->create(['city_id' => $city->id]);

        $this->actingAs($user, 'sanctum');

        $response = $this->deleteJson("/api/postalcode/{$postalcode->id}");

        $response->assertOk()
                 ->assertJsonPath('message', 'Postalcode deleted successfully');
        $this->assertDatabaseMissing('postal_codes', ['id' => $postalcode->id]);
    }

    // ----------------------------------------
    // GUEST RESTRICTIONS
    // ----------------------------------------

    #[Test]
    public function guest_cannot_create_update_or_delete_postalcode()
    {
        $originalPostalCode = fake()->numberBetween(1, 99999);
        $newPostalCode = $originalPostalCode + 1;

        $county = County::factory()->create();
        $city = City::factory()->create(['county_id' => $county->id]);
        $postalcode = PostalCode::factory()->create(['city_id' => $city->id]);

        $this->postJson('/api/postalcode', ['postal_code' => $originalPostalCode, 'city_id' => $city->id])
             ->assertUnauthorized();

        $this->patchJson("/api/postalcode/{$postalcode->id}", ['postal_code' => $newPostalCode])
             ->assertUnauthorized();

        $this->deleteJson("/api/postalcode/{$postalcode->id}")
             ->assertUnauthorized();
    }
}
