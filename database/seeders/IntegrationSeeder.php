<?php

namespace Database\Seeders;

use App\Models\Sameleon\Integration;
use Illuminate\Database\Seeder;

class IntegrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $integrations = [
            ['name' => 'Elementor', 'header' => 'x-elementor', 'slug' => 'elementor', 'logo' => 'integrations/elementor.png', 'active' => true],
            ['name' => 'WooCommerce', 'header' => 'x-wc-webhook-signature', 'slug' => 'woocommerce', 'logo' => 'integrations/woocommerce.png', 'active' => true],

        ];

        foreach ($integrations as $integration) {
            Integration::create($integration);
        }
    }
}
