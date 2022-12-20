<?php

namespace Tests\Feature\Sameleon\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterClientTest extends TestCase
{
    //use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function testRegiterNewClient()
    {
        // Run the DatabaseSeeder...
        // $this->seed();
        // Create a single App\Models\User instance...
        $user = User::factory()->create();

        $this->assertDatabaseCount('users', 1);
    }
}
