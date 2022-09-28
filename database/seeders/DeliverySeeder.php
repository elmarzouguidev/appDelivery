<?php

namespace Database\Seeders;

use App\Models\Sameleon\User;
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
            'is_admin' => false
        ];

        $user2 =  [
            'nom' => 'Anas',
            'prenom' => 'Anas',
            'email' => 'anas@gmail.com',
            'telephone' => '0677512751',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'is_admin' => false
        ];

        $user4 =  [
            'nom' => 'Abir',
            'prenom' => 'Arfaoui',
            'email' => 'company@gmail.com',
            'telephone' => '0677512759',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'is_delivery' => true,
            'type' => 'entreprise',
            'city_id' => 12
        ];

        $delivery = User::whereEmail('chaligui@gmail.com')->first();
        $delivery2 = User::whereEmail('anas@gmail.com')->first();
        $delivery4 = User::whereEmail('company@gmail.com')->first();

        if (!$delivery && !$delivery2 && !$delivery4) {

            $newAdmin =  User::create($user);
            $newAdmin->assignRole('Delivery');

            $newAdmin2 =  User::create($user2);
            $newAdmin2->assignRole('Delivery');

            $newDeliveyCompany =  User::create($user4);
            $newDeliveyCompany->assignRole('DeliveryEntreprise');
        } else {

            $delivery->assignRole('Delivery');

            $delivery2->assignRole('Delivery');

            $delivery4->assignRole('DeliveryEntreprise');
        }
    }
}
