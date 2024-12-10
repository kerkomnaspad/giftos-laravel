<?php

namespace Database\Seeders;

use App\Models\items;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i=1;$i<=20;$i++)
        {
            items::insert([
                'name'=>fake()->name(),
                'type_id'=>fake()->numberBetween(1,4),
                'quantity'=>fake()->numberBetween(1,10),
                'image'=>fake()->imageUrl(),
                'price'=>fake()->numberBetween(100000,500000),
                'description'=>fake()->paragraph(),
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}
