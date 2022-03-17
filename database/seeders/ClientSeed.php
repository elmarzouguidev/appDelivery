<?php

namespace Database\Seeders;

use App\Models\Sameleon\Client;
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
            'email' => 'ouhadi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
        ];

        $client = Client::whereEmail('ouhadi@gmail.com')->first();

        if (!$client) {

            $newAdmin =  Client::create($user);
            $newAdmin->assignRole('Client');

        } else {

            $client->assignRole('Client');
        }
    }
}
