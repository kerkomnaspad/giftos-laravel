<?php

namespace Database\Seeders;

use App\Models\itemtypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemtypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // for($i=1;$i<=5;$i++)
        // {
            itemtypes::insert([
                'name'=>'Electronics',
                'image'=>fake()->imageUrl(),
                'description'=>fake()->paragraph()
            ]);

            itemtypes::insert([
                'name'=>'Furniture',
                'image'=>fake()->imageUrl(),
                'description'=>fake()->paragraph()
            ]);

            itemtypes::insert([
                'name'=>'Toys and Hobbies',
                'image'=>fake()->imageUrl(),
                'description'=>fake()->paragraph()
            ]);

            itemtypes::insert([
                'name'=>'Wearables',
                'image'=>fake()->imageUrl(),
                'description'=>fake()->paragraph()
            ]);

            
        // }
    }
}
