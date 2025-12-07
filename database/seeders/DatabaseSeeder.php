<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Eloquent\Factories\Sequence;
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
        \App\Models\Admin::factory()->create([
            'name'=>'Developer',
            'email'=>'developer@readymovers.com'
        ]);

        \App\Models\Floor::factory()->count(9)->state(new Sequence(
            ['name'=>'Basement', 'multiplier'=>2],
            ['name'=>'Ground floor', 'multiplier'=>4],
            ['name'=>'First floor', 'multiplier'=>6],
            ['name'=>'Second floor', 'multiplier'=>8],
            ['name'=>'Third floor', 'multiplier'=>10],
            ['name'=>'Fourth floor', 'multiplier'=>12],
            ['name'=>'Fifth floor', 'multiplier'=>14],
            ['name'=>'Sixth floor', 'multiplier'=>16],
            ['name'=>'Above sixth floor', 'multiplier'=>20],      
        ))->create();

        \App\Models\Item::factory()->count(19)->state(new Sequence(
            ['name'=>'Sofas'],
            ['name'=>'Chest Drawers'],
            ['name'=>'Wardrobe'],
            ['name'=>'Television'],
            ['name'=>'Washing Machine'],
            ['name'=>'Cookers'],
            ['name'=>'Divan'],
            ['name'=>'Mattress'],
            ['name'=>'Table'],
            ['name'=>'Small Boxes'],
            ['name'=>'Medium Boxes'],
            ['name'=>'Large Boxes'],
            ['name'=>'Luggage / Bags'],
            ['name'=>'Bedside Drawers'],
            ['name'=>'Coffee Table'],
            ['name'=>'TV Stand'],
            [
                'name'=>'Hire Handyman',
                'isCountable'=>false,
            ],
            [
                'name'=>'Furnitures dismantling and assembling',
                'isCountable'=>false
            ],
            [
                'name'=>'Packing and Unpacking',
                'isCountable'=>false
            ],      
        ))->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
