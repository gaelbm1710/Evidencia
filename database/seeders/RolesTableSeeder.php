<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::insert([
            ['name' => 'Sales', 'description' => 'Handles customer orders.'],
            ['name' => 'Purchasing', 'description' => 'Manages material purchases.'],
            ['name' => 'Warehouse', 'description' => 'Prepares and manages orders.'],
            ['name' => 'Route', 'description' => 'Handles order deliveries.']
        ]);
    }
}
