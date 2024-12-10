<?php

namespace Database\Seeders;

use App\Models\carts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // for($i=1;$i<=20;$i++)
        // {
        //     carts::insert([
        //         'user_id'=>fake()->randomNumber(1,5),
        //         'item_id'=>fake()->randomNumber(1,5),
        //         'quantity'=>fake()->randomNumber(1,5),
        //         'status'=>fake()->randomNumber(0,2)
        //     ]);
        // }
    }
}
