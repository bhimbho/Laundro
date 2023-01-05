<?php

namespace Tests\Feature;

use App\Models\Administrator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthControllerTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_admin_can_register_new_user() {
        $response = $this->post('/api/admin/register',
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'johnDoe@gmail.com',
                'username' => 'johndoe',
                'password' => 'password',
                'password_confirmation' => 'password',
                'role' => 'super-admin',
            ]
           
        );
        $response->assertStatus(201);
        $response->assertSuccessful();
    }

    public function test_admin_can_login_succesfully()
    {
        Administrator::factory()->create([
            'email' => 'johnDoe@gmail.com',
            'password' => bcrypt('password')
        ]);
        
        $response = $this->postJson(route('login'), [
            'email' => 'johnDoe@gmail.com',
            'password' => 'password'
        ]);
        $response->assertSuccessful();
    }

    public function test_login_fails_without_email()
    {
        Administrator::factory()->create([
            'email' => 'johnDoe@gmail.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->postJson(route('login'), [
            'email' => '',
            'password' => 'password'
        ]);

        $response->assertJsonValidationErrors('email');
    }

    public function test_validation_tracks_invalid_password()
    {
        Administrator::factory()->create([
            'email' => 'johnDoe@gmail.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->postJson(route('login'), [
            'email' => 'johnDoe@gmail.com',
            'password' => ''
        ]);

        $response->assertJsonValidationErrors('password');
    }

    public function test_login_fails_incorrect_password()
    {
        Administrator::factory()->create([
            'email' => 'johnDoe@gmail.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->postJson(route('login'), [
            'email' => 'johnDoe@gmail.com',
            'password' => 'passwordx'
        ]);

        $response->assertStatus(401);
        $response->assertJsonStructure(['error']);
    }
}
