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
            ['name' => 'CIH BANK', 'code_bank' => 0014, 'code_swift' => 'CIBBKGB22', 'code_rib' => 'CH0014','logo' => 'banks/cih-bank.png', 'addresse' => 'Casablanca', 'description' => 'Bank', 'active' => true],
            ['name' => 'SGMB', 'code_bank' => 0015, 'code_swift' => 'CSMGGB22', 'code_rib' => 'SGM0015','logo' => 'banks/sgmb-bank.jpg', 'addresse' => 'Casablanca', 'description' => 'Bank', 'active' => true],
            ['name' => 'Attijari', 'code_bank' => 007, 'code_swift' => 'ATTGGB22', 'code_rib' => 'SATT0075','logo' => 'banks/attijari-bank.png', 'addresse' => 'Casablanca', 'description' => 'Bank', 'active' => true],

        ];

        foreach ($banks as $bank) {
            Bank::create($bank);
        }
    }
}
