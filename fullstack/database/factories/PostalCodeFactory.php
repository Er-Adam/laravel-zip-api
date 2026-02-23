<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\PostalCode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PostalCode>
 */
class PostalCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "postal_code" => $this->faker->numberBetween(1, 99999),
            'city_id' => City::factory(),
        ];
    }
}
