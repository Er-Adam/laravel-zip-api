<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\County;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = array_map('str_getcsv', file(database_path('seeders/data/iranyitoszamok.csv')));

        $cities = [];

        foreach ($csv as $row) {
            $cities[$row[2]] = 0;
        }

        foreach ($cities as $city => $v) {
            County::create([
                "name" => $city,
            ]);
        }
    }
}
