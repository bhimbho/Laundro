<?php

namespace Database\Factories;

use App\Models\Administrator;
use App\Models\Customer;
use App\Models\DeliveryMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
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
            'customer_id' => $this->faker->randomElement(Customer::all())['id'],
            'payment_type' => $this->faker->title(),
            'authorised_by' => $this->faker->randomElement(Administrator::where('role', 'super-admin')->get())['id'],
            'delivery_method_id' => $this->faker->randomElement(DeliveryMethod::all())['id'],
        ];
    }
}
