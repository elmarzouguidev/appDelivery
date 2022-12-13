<?php

namespace Database\Seeders;

use App\Models\Sameleon\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tages = [
            ['name' => 'woocommerce', 'color' => '#ffffff'],
            ['name' => 'elementor', 'color' => '#ffffff'],
            ['name' => 'youcan', 'color' => '#ffffff'],
            ['name' => 'shopify', 'color' => '#ffffff'],
            ['name' => 'api', 'color' => '#ffffff'],
            ['name' => 'excel', 'color' => '#ffffff'],
        ];

        collect($tages)->each(function ($tag) {
            Tag::create($tag);
        });
    }
}
