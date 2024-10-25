<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    Role::create(['name' => 'Sales']);
    Role::create(['name' => 'Purchasing']);
    Role::create(['name' => 'Warehouse']);
    Role::create(['name' => 'Route']);
    }
}
