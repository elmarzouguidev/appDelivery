<?php

namespace Database\Seeders;

use App\Models\Sameleon\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            ['name' => 'CIH BANK', 'logo' => 'banks/cih-bank.png', 'active' => true],
            ['name' => 'SGMB', 'logo' => 'banks/sgmb-bank.png', 'active' => true],
        ];

        foreach ($banks as $bank) {
            Bank::create($bank);
        }
    }
}
