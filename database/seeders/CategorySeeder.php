<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Desserts', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Main Course', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dinner', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Seafood', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mexican Cousine', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Italian Cousine', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'American Cousine', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
