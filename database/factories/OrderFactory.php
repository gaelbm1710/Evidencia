<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Invoice;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statusOptions = ['Ordered', 'In process', 'In route', 'Delivered'];
        return [
            'invoice_number' => Invoice::factory(),
            'customer_id' => Customer::factory(),
            'order_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'delivery_address' => $this->faker->address,
            'notes' => $this->faker->sentence,
            'status' => $this->faker->randomElement($statusOptions),
            'photo_route' => null,
            'photo_delivery' => null,
        ];
    }
}
