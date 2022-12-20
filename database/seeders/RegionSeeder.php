<?php

namespace Database\Seeders;

use App\Models\Sameleon\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            ['name' => 'MOHAMMEDIA', 'slug' => Str::slug('MOHAMMEDIA'), 'frais' => 5.00, 'city_id' => 1],
            ['name' => 'TIZNIT', 'slug' => Str::slug('TIZNIT'), 'frais' => 5.00, 'city_id' => 12],
            ['name' => 'BOUZNIKA', 'slug' => Str::slug('BOUZNIKA'), 'frais' => 5.00, 'city_id' => 1],
        ];

        collect($regions)->each(function ($region) {
            Region::create($region);
        });
    }
}
