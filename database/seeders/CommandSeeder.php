<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sameleon\Command;

class CommandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($user)
    {
        Command::factory(50)->create(['user_id' => $user->id, 'user_uuid' => $user->uuid]);
    }
}
