<?php

namespace Database\Seeders;

use App\Models\Sameleon\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  [
            'nom' => 'Ahmed',
            'prenom' => 'Ouahdi',
            'telephone' => '0677512750',
            'email' => 'client@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
        ];

        $user2 =  [
            'nom' => 'khalid',
            'prenom' => 'client',
            'telephone' => '0677512758',
            'email' => 'clients@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
        ];

        $client = User::whereEmail('client@gmail.com')->first();

        $client2 = User::whereEmail('client2@gmail.com')->first();

        if (!$client && !$client2) {

            $newAdmin =  User::create($user);
            $newAdmin->assignRole('Client');

            $newAdmin2 =  User::create($user2);
            $newAdmin2->assignRole('Client');
            
        } else {

            $client->assignRole('Client');
            $client2->assignRole('Client');
        }
    }
}
