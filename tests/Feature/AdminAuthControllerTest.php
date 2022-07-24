<?php

namespace Tests\Feature;

use App\Http\Enum\RoleEnum;
use App\Models\Administrator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
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
        
        $this->withoutExceptionHandling();
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
        $this->assertInstanceOf(Administrator::class, $response->getOriginalContent()['data']);
    }
}
