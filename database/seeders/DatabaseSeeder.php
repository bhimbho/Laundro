<?php

namespace Database\Seeders;

use App\Models\AttireType;
use App\Models\DeliveryMethod;
use App\Models\Service;
use App\Models\ServiceCost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AttireTypeSeeder::class,
            AdministratorSeeder::class,
            CustomerSeeder::class,
            ServiceSeeder::class,
            ServiceCostSeeder::class,
            DeliveryMethodSeeder::class,
            TransactionSeeder::class,
            BookingRecordSeeder::class,
        ]);
    }
}
