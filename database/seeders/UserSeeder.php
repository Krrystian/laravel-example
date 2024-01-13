<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'admin', 'email' => 'admin@admin.com', 'password' => bcrypt('Administrator'), 'privilege' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wojciech Ross', 'email' => 'wojciech.ross@wr.com', 'password' => bcrypt('WojRoss123'), 'privilege' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'test', 'email' => 'test@test.com', 'password' => bcrypt('KontoTest11'), 'privilege' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Agnieszka Niemieszka', 'email' => 'agnieszka.niemieszka@an.com', 'password' => bcrypt('AgnieszkaNiemieszka123'), 'privilege' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}