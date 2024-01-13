<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Category_RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = now();

        DB::table('category_recipe')->insert([
            ['category_id' => 1, 'recipe_id' => 1, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp], // Pancakes => Desserts
            ['category_id' => 2, 'recipe_id' => 2, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp], // Spaghetti => Main Courses
            ['category_id' => 6, 'recipe_id' => 3, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp], // Italian => Pizza
            ['category_id' => 5, 'recipe_id' => 4, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp], // Mexican => Tacos
            ['category_id' => 2, 'recipe_id' => 5, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp], // Main Courses => Lasagna
            ['category_id' => 7, 'recipe_id' => 6, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp], // American => Burger
            ['category_id' => 7, 'recipe_id' => 7, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp], // American => Hot-Dog
        ]);
    }
}
