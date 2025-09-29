<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\PostalCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostalCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = array_map('str_getcsv', file(database_path('seeders/data/iranyitoszamok.csv')));

        $postalCodes = [];

        foreach ($csv as $row) {
            $code = $row[0];
            $cityName = $row[1];
            $city = City::where('name', $cityName)->first();
            PostalCode::create([
                "postal_code" => $code,
                "city_id" => $city->id
            ]);
        }


    }
}
