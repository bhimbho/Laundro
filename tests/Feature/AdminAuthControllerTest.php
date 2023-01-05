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
    // public function test_example()
    // {
    //     $response = $this->post('/');

    //     $response->assertStatus(200);
    // }

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
        
        $response = $this->post(route('login'), [
            'email' => 'johnDoe@gmail.com',
            'password' => 'password'
        ]);
        $response->assertSuccessful();
    }
}
