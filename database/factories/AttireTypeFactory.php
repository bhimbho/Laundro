<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttireType>
 */
class AttireTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'attire_image' => $this->faker->image(public_path('storage/attires'), 400, 300,null, false),
            'group' => $this->faker->randomElement(['kiddies-wears', 'normal-wear', 'large-wears', 'xxl-wear']),
        ];
    }
}
