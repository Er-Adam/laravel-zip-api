<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\County;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;

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

        $count = count($cities);
        $output = $this->command->getOutput();
        $progressBar = new ProgressBar($output, $count);

        $progressBar->setBarCharacter('<bg=white> </>');
        $progressBar->setEmptyBarCharacter('<bg=black>.</>');
        $progressBar->setProgressCharacter('<bg=green> </>');

        $output->writeln("Seeding $count cities");
        $progressBar->start();

        foreach ($cities as $city => $countyName) {

            $county = County::where('name', $countyName)->first();

            City::create([
                "name" => $city,
                "county_id" => $county->id,
            ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $output->writeln("\nCity seeding complete");
    }
}
