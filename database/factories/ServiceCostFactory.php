<?php

namespace Database\Factories;

use App\Models\AttireType;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceCost>
 */
class ServiceCostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cost' => $this->faker->numberBetween(4000,6000),
            'service_id' => $this->faker->randomElement(Service::all())['id'],
            'attire_type_id' => $this->faker->randomElement(AttireType::all())['id'],
        ];
    }
}
