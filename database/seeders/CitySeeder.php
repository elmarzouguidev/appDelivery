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
            ['name' =>'Casablanca'],
            ['name'=>'Mohammadia'],
            ['name'=>'Ain harrouda'],
            ['name'=>'Bouskoura'],
            ['name'=>'Dar bouazza'],
            ['name'=>'Errahma'],
            ['name'=>'Had soualem'],
            ['name'=>'Mediouna'],
            ['name'=>'Nouaceur'],
            ['name'=>'Sidi rahhal'],
            ['name'=>'Tit mellil'],
        ];

        foreach($cities as $city)
        {
            City::create($city);
        }
    }
}
