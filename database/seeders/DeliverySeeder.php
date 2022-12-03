<?php

namespace Database\Seeders;

use App\Models\Sameleon\City;
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

        //Delivery::query()->truncate();

        $agadir = City::whereSlug('agadir')->first(); //agadir
        $casa = City::whereSlug('casablanca')->first(); //casablanca
        $user =  [
            'nom' => 'khalid',
            'prenom' => 'livreur',
            'email' => 'khalid@gmail.com',
            'telephone' => '0677512754',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'is_company' => false,
            'type' => 'particulier',
            'city_id' => $casa->id,
            'city_uuid' => $casa->uuid
        ];

        $user2 =  [
            'nom' => 'karim',
            'prenom' => 'livreur',
            'email' => 'karim@gmail.com',
            'telephone' => '0677512751',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'is_company' => false,
            'type' => 'particulier',
            'city_id' => $casa->id,
            'city_uuid' => $casa->uuid
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
            'company_name' => 'ARFAOUI SARL',
            'company_ice' => '000154780325477',
            'type' => 'entreprise',
            'city_id' => $agadir->id,
            'city_uuid' => $agadir->uuid
        ];

        $delivery = Delivery::whereEmail('karim@gmail.com')->first();
        $delivery2 = Delivery::whereEmail('khalid@gmail.com')->first();
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
