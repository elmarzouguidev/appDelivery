<?php

namespace Database\Seeders;

use App\Models\Sameleon\Delivery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  [
            'nom' => 'Aboudi',
            'prenom' => 'Khalid',
            'email' => 'aboudi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'user_id' => 8
        ];

        $user2 = [
            'nom' => 'Alamai',
            'prenom' => 'Yassine',
            'email' => 'alami@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'user_id' => 8
        ];

        $delivery = Delivery::whereEmail('aboudi@gmail.com')->first();

        $delivery2 = Delivery::whereEmail('alami@gmail.com')->first();


        if (!$delivery &&  !$delivery2) {

            Delivery::create($user);

            Delivery::create($user2);
        }
    }
}
