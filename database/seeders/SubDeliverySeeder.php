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
        $user = [
            'nom' => 'Aboudi',
            'prenom' => 'Khalid',
            'email' => 'aboudi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@'),
            'remember_token' => Str::random(10),
            'parent_id' => 2,
        ];

        $delivery = Delivery::whereEmail('aboudi@gmail.com')->first();

        if (! $delivery) {
            $user1 = Delivery::create($user);

            $user1->assignRole('SubDelivery');
        } else {
            $delivery->assignRole('SubDelivery');
        }
    }
}
