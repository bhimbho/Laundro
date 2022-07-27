<?php

namespace Database\Factories;

use App\Models\AttireType;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookingRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'transaction_id' => $this->faker->randomElement(Transaction::all())['id'],
            'attire_type_id' => $this->faker->randomElement(AttireType::all())['id'],
            'service_id' => $this->faker->randomElement(Service::all())['id'],
            'quantity' => $this->faker->numberBetween(1,20),
            'express' => $this->faker->randomElement([0, 1]),
            'status' => 'tagging',
            'expected_collection_date' => $this->faker->date("Y-m-d", '2days'),
        ];
    }
}
