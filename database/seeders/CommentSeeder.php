<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $recipes = DB::table('recipes')->pluck('id')->toArray();
        $users = DB::table('users')->pluck('id')->toArray();

        foreach ($recipes as $recipeId) {
            $numComments = rand(1, 5); // Adjust the range as needed

            for ($i = 0; $i < $numComments; $i++) {
                DB::table('comments')->insert([
                    'recipe_id' => $recipeId,
                    'user_id' => $faker->randomElement($users),
                    'comment' => $faker->sentence,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
