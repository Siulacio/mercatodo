<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_be_created() : void
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/users',[
            'name' => 'new User',
            'last_name' => 'new last name',
            'identification'=>'1234567895',
            'address' => 'new address',
            'phone' => '9009009000',
            'email' => 'newnew@example.com',
            'email_verified_at' => date('Y-m-s H:m:s'),
            'role' => 'standar',
            'state'=>true,
            'password' => 'password',
        ]);
//        dd($response->json());
        $response->assertOk();
        $user = User::latest()->first();
        $this->assertEquals($user->identification, '1234567895');
    }

    public function test_get_users() : void
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/users');
        $response->assertOk();
        $this->assertCount(3, User::get());
    }
}
