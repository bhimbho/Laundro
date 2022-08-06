<?php

namespace Database\Factories;

use App\Models\AttireType;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ServiceMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'hours' => $this->faker->randomElement(['6','12','24']),
            'cost' => $this->faker->numberBetween(1500,2000),
            'group' => $this->faker->randomElement(['kiddies-wears', 'normal-wear', 'large-wears', 'xxl-wear']),
            'service_id' => $this->faker->randomElement(Service::all())['id'],
        ];
    }
}
