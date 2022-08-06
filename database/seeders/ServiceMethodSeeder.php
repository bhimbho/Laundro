<?php

namespace Database\Seeders;

use App\Models\ServiceMethod;
use Illuminate\Database\Seeder;

class ServiceMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceMethod::factory(10)->create();
    }
}
