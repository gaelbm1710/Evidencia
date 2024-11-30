<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Status::insert([
            ['name' => 'Ordered', 'description' => 'Order has been placed.'],
            ['name' => 'In process', 'description' => 'Order is being prepared.'],
            ['name' => 'In route', 'description' => 'Order is en route to delivery.'],
            ['name' => 'Delivered', 'description' => 'Order has been delivered.']
        ]);
    }
}
