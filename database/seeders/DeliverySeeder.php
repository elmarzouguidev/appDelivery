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

        $delivery = User::whereEmail('chaligui@gmail.com')->first();
        $delivery2 = User::whereEmail('anas@gmail.com')->first();

        if (!$delivery && !$delivery2) {

            $newAdmin =  User::create($user);
            $newAdmin->assignRole('Delivery');

            $newAdmin2 =  User::create($user2);
            $newAdmin2->assignRole('Delivery');
            
        } else {

            $delivery->assignRole('Delivery');

            $delivery2->assignRole('Delivery');
        }
    }
}
