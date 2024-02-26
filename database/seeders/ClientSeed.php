<?php

namespace Database\Seeders;

use App\Models\Sameleon\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class ClientSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all()->pluck('name');

        $user = [
            'nom' => 'Sameleon',
            'prenom' => 'Client',
            'telephone' => '0677512850',
            'email' => 'client@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password@'),
            'remember_token' => Str::random(10),
            'is_client' => true,
            'addresse' => 'casablanca Maarif Rue 15',
            'cnie' => 'p12541',
            'actived_at' => now(),
        ];

        $client = User::whereEmail('client@gmail.com')->first();

        if (!$client) {
            $newAdmin = User::create($user);
            $newAdmin->assignRole('Client');

            $newAdmin->syncPermissions($permissions);
        } else {
            $client->assignRole('Client');

            $client->syncPermissions($permissions);
        }
    }
}
