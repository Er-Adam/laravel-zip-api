<?php

namespace Database\Seeders;

use App\Models\County;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;

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

        $count = count($cities);
        $output = $this->command->getOutput();
        $progressBar = new ProgressBar($output, $count);

        $progressBar->setBarCharacter('<bg=white> </>');
        $progressBar->setEmptyBarCharacter('<bg=black>.</>');
        $progressBar->setProgressCharacter('<bg=green> </>');

        $output->writeln("Seeding $count counties");
        $progressBar->start();

        foreach ($cities as $city => $v) {
            County::create([
                "name" => $city,
            ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $output->writeln("\nCounty seeding complete");
    }
}
