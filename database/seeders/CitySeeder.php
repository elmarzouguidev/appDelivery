<?php

namespace Database\Seeders;

use App\Models\Sameleon\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['name' => 'Casablanca', 'frais' => 14],
            ['name' => 'Mohammadia', 'frais' => 20],
            ['name' => 'Ain harrouda', 'frais' => 20],
            ['name' => 'Bouskoura', 'frais' => 14],
            ['name' => 'Dar bouazza', 'frais' => 14],
            ['name' => 'Errahma', 'frais' => 14],
            ['name' => 'Had soualem', 'frais' => 14],
            ['name' => 'Mediouna', 'frais' => 20],
            ['name' => 'Nouaceur', 'frais' => 20],
            ['name' => 'Sidi rahhal', 'frais' => 20],
            ['name' => 'Tit mellil', 'frais' => 20],
            ['name' => 'Agadir', 'frais' => 25,'has_profit'=>true,'profit'=>15],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
