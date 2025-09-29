<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\County;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = array_map('str_getcsv', file(database_path('seeders/data/iranyitoszamok.csv')));

        $cities = [];

        foreach ($csv as $row) {
            $cities[$row[1]] = $row[2];
        }

        foreach ($cities as $city => $countyName) {

            $county = County::where('name', $countyName)->first();

            City::create([
                "name" => $city,
                "county_id" => $county->id,
            ]);
        }
    }
}
