<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'company_name' => $this->faker->company,
            'customer_number' => $this->faker->unique()->numerify('CUST####'),
            'fiscal_data' => $this->faker->address,
            'delivery_address' => $this->faker->address,
        ];
    }
}
