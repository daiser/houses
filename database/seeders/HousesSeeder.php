<?php

namespace Database\Seeders;

use App\Exceptions\BadOperation;
use App\Models\House;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HousesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $data_file = fopen(database_path('seeders/property-data.csv'), 'r');
        if ($data_file === false) {
            throw new BadOperation('failed to open data-file');
        }

        try {
            $ignored_header = fgetcsv($data_file);
            if ($ignored_header === false) {
                throw new BadOperation('failed to read csv-header');
            }

            DB::transaction(
                function() use ($data_file)
                {
                    while (($row = fgetcsv($data_file)) !== false) {
                        $new_house = new House();

                        $new_house->name      = $row[0];
                        $new_house->price     = intval($row[1]);
                        $new_house->bedrooms  = intval($row[2]);
                        $new_house->bathrooms = intval($row[3]);
                        $new_house->storeys   = intval($row[4]);
                        $new_house->garages   = intval($row[5]);
                        $new_house->save();
                    }
                }
            );
        } finally {
            fclose($data_file);
        }
    }
}
