<?php

namespace Database\Seeders;

use App\Models\Sameleon\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'nom' => 'Elmarzougui',
            'prenom' => 'Abdelghafour',
            'email' => 'abdelgha4or@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@2023'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ];

        $user2 = [
            'nom' => 'MAHMALJI',
            'prenom' => 'SAMI',
            'email' => 'sameleon.express@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@2023'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ];

        $user3 = [
            'nom' => 'Benbella',
            'prenom' => 'Soufian',
            'email' => 'soufian.benbella19@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789@2023'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ];

        $admin = User::whereEmail('abdelgha4or@gmail.com')->first();

        $admin2 = User::whereEmail('sameleon.express@gmail.com')->first();

        $admin3 = User::whereEmail('soufian.benbella19@gmail.com')->first();

        if (! $admin && ! $admin2 && ! $admin3) {
            $newAdmin = User::create($user);

            $newAdmin->assignRole('SuperAdmin');

            $newAdmin2 = User::create($user2);

            $newAdmin2->assignRole('SuperAdmin');

            $newAdmin3 = User::create($user3);

            $newAdmin3->assignRole('SuperAdmin');
        } else {
            $admin->assignRole('SuperAdmin');

            $admin2->assignRole('SuperAdmin');

            $admin3->assignRole('SuperAdmin');
        }
    }
}
