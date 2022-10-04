<?php

namespace Database\Seeders;

use App\Models\Sameleon\Delivery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  [
            'nom' => 'Mohammed',
            'prenom' => 'Chaligui',
            'email' => 'chaligui@gmail.com',
            'telephone' => '0677512754',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'is_company' => false
        ];

        $user2 =  [
            'nom' => 'Anas',
            'prenom' => 'Anas',
            'email' => 'anas@gmail.com',
            'telephone' => '0677512751',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'is_company' => false
        ];

        $user4 =  [
            'nom' => 'Abir',
            'prenom' => 'Arfaoui',
            'email' => 'company@gmail.com',
            'telephone' => '0677512759',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'is_company' => true,
            'company_name' => 'entreprise',
            'city_id' => 12
        ];

        $delivery = Delivery::whereEmail('chaligui@gmail.com')->first();
        $delivery2 = Delivery::whereEmail('anas@gmail.com')->first();
        $delivery4 = Delivery::whereEmail('company@gmail.com')->first();

        if (!$delivery && !$delivery2 && !$delivery4) {

            $newAdmin =  Delivery::create($user);
            $newAdmin->assignRole('Delivery');

            $newAdmin2 =  Delivery::create($user2);
            $newAdmin2->assignRole('Delivery');

            $newDeliveyCompany =  Delivery::create($user4);
            $newDeliveyCompany->assignRole('DeliveryEntreprise');
        } else {

            $delivery->assignRole('Delivery');

            $delivery2->assignRole('Delivery');

            $delivery4->assignRole('DeliveryEntreprise');
        }
    }
}
