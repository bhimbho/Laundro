<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Administrator>
 */
class AdministratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->name(),
            'lastname' => $this->faker->name(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(12),
            'role' => $this->faker->randomElement(['super-admin', 'frontdesk']),
        ];
    }
}
