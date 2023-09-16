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
            ['name' => 'Casablanca', 'slug' => 'casablanca', 'frais' => 14, 'has_profit' => true, 'profit' => 0],
            ['name' => 'Mohammadia', 'slug' => 'mohammadia', 'frais' => 20, 'has_profit' => true, 'profit' => 10],
            ['name' => 'Rabat', 'slug' => 'rabat', 'frais' => 20, 'has_profit' => true, 'profit' => 15],
            ['name' => 'Fés', 'slug' => 'fes', 'frais' => 30, 'has_profit' => true, 'profit' => 15],
            ['name' => 'Marrakech', 'slug' => 'marrakech', 'frais' => 30, 'has_profit' => true, 'profit' => 15],
            ['name' => 'Tanger', 'slug' => 'tanger', 'frais' => 30, 'has_profit' => true, 'profit' => 15],
            ['name' => 'Salé', 'slug' => 'sale', 'frais' => 20, 'has_profit' => true, 'profit' => 15],
            ['name' => 'Meknès', 'slug' => 'meknes', 'frais' => 30, 'has_profit' => true, 'profit' => 15],
            ['name' => 'Oujda', 'slug' => 'oujda', 'frais' => 30, 'has_profit' => true, 'profit' => 15],
            ['name' => 'Kénitra', 'slug' => 'kenitra', 'frais' => 20, 'has_profit' => true, 'profit' => 15],
            ['name' => 'Tétouan', 'slug' => 'tetouan', 'frais' => 30, 'has_profit' => true, 'profit' => 15],
            ['name' => 'Agadir', 'slug' => 'agadir', 'frais' => 25, 'has_profit' => true, 'profit' => 15],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
