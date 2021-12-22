<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
 //   use RefreshDatabase;

    public function test_login_screen_can_be_rendered() : void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen() : void
    {
        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => '123',
        ]);

        $this->assertAuthenticated();
        //$response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password() : void
    {
        $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => '124',
        ]);

        $this->assertGuest();
    }

    public function test_user_can_login_as_admin() : void
    {
        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => '123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('admin');
    }

    public function test_user_can_login_as_standar() : void
    {
        $response = $this->post('/login', [
            'email' => 'standar@example.com',
            'password' => '123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_user_can_not_login_inactive() : void
    {
        $this->post('/login', [
            'email' => 'inactive@example.com',
            'password' => '123',
        ]);

        $this->assertGuest();
    }

    public function test_user_exceed_attemps_limit() : void
    {
        for ($i=0; $i<5; $i++){
           $response = $this->post('/login', [
                'email' => 'none@example.com',
                'password' => 'wrong',
            ]);
//            $response->assertStatus(422);
        }

        $response = $this->post('/login', [
            'email' => 'none@example.com',
            'password' => 'wrong',
        ]);

        $response->assertStatus(302);
    }
}
