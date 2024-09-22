<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\User;
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
        User::factory(1)->create();
        Order::factory(1)->create([
            'freight_payer_self' => false,
            'bl_release_date' => null
        ]);
        Order::factory(1)->create([
            'bl_release_date' => fake()->dateTime
        ]);
        Order::factory(1)->create([
            'freight_payer_self' => true,
            'bl_release_date' => null
        ]);

    }
}
