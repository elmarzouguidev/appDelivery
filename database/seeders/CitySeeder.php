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
        /*$cities = [
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
        ];*/

        $cities = [
            ['name' => 'Casablanca', 'frais' => 14,'has_profit'=>true,'profit'=>0],
            ['name' => 'Mohammadia', 'frais' => 20,'has_profit'=>true,'profit'=>10],
            ['name' => 'Rabat', 'frais' => 20,'has_profit'=>true,'profit'=>15],
            ['name' => 'Fés', 'frais' => 30,'has_profit'=>true,'profit'=>15],
            ['name' => 'Marrakech', 'frais' => 30,'has_profit'=>true,'profit'=>15],
            ['name' => 'Tanger', 'frais' => 30,'has_profit'=>true,'profit'=>15],
            ['name' => 'Salé', 'frais' => 20,'has_profit'=>true,'profit'=>15],
            ['name' => 'Meknès', 'frais' => 30,'has_profit'=>true,'profit'=>15],
            ['name' => 'Oujda', 'frais' => 30,'has_profit'=>true,'profit'=>15],
            ['name' => 'Kénitra', 'frais' => 20,'has_profit'=>true,'profit'=>15],
            ['name' => 'Tétouan', 'frais' => 30,'has_profit'=>true,'profit'=>15],
            ['name' => 'Agadir', 'frais' => 25,'has_profit'=>true,'profit'=>15],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
