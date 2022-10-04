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
            'parent_id' => 8
        ];

        $user2 = [
            'nom' => 'Alamai',
            'prenom' => 'Yassine',
            'email' => 'alami@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'parent_id' => 8
        ];

        $delivery = Delivery::whereEmail('aboudi@gmail.com')->first();

        $delivery2 = Delivery::whereEmail('alami@gmail.com')->first();


        if (!$delivery &&  !$delivery2) {

            $user1 = Delivery::create($user);

            $user2 = Delivery::create($user2);

            $user1->assignRole('SubDelivery');

            $user2->assignRole('SubDelivery');
        } else {
            $delivery->assignRole('SubDelivery');

            $delivery2->assignRole('SubDelivery');
        }
    }
}
