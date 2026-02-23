<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\PostalCode;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;

class PostalCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = array_map('str_getcsv', file(database_path('seeders/data/iranyitoszamok.csv')));

        $count = count($csv);
        $output = $this->command->getOutput();
        $progressBar = new ProgressBar($output, $count);

        $progressBar->setBarCharacter('<bg=white> </>');
        $progressBar->setEmptyBarCharacter('<bg=black>.</>');
        $progressBar->setProgressCharacter('<bg=green> </>');

        $output->writeln("Seeding $count postal codes");
        $progressBar->start();

        foreach ($csv as $row) {
            $code = $row[0];
            $cityName = $row[1];
            $city = City::where('name', $cityName)->first();
            PostalCode::create([
                "postal_code" => $code,
                "city_id" => $city->id
            ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $output->writeln("\nPostal code seeding complete");
    }
}
