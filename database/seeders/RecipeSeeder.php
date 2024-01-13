<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('recipes')->insert([
            [
                'title' => 'Pancakes',
                'instructions' => 'Pancakes with blueberries and maple syrup. These fluffy pancakes are perfect for breakfast or brunch.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'ingredients' => 'Flour' . PHP_EOL . 'Milk' . PHP_EOL . 'Eggs' . PHP_EOL . 'Blueberries' . PHP_EOL . 'Maple syrup',
                'likes' => json_encode([rand(100, 999)]),
                'prep_time' => '00:30:00',
                'cook_time' => '00:30:00',
                'servings' => 4,
                'public' => true,
                'image' => 'pancake.jpg',
            ],
            [
                'title' => 'Spaghetti',
                'instructions' => 'Spaghetti with tomato sauce and meatballs. This classic Italian dish is a family favorite.',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'ingredients' => 'Spaghetti' . PHP_EOL . 'Tomato sauce' . PHP_EOL . 'Ground beef' . PHP_EOL . 'Onion' . PHP_EOL . 'Garlic',
                'likes' => json_encode([rand(100, 999), rand(100, 999), rand(100, 999)]),
                'prep_time' => '01:00:00',
                'cook_time' => '00:10:00',
                'servings' => 2,
                'public' => true,
                'image' => 'spaghetti.jpeg',
            ],
            [
                'title' => 'Pizza',
                'instructions' => 'Pizza with cheese, pepperoni, and vegetables. This homemade pizza is delicious and easy to make.',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'ingredients' => 'Pizza dough' . PHP_EOL . 'Tomato sauce' . PHP_EOL . 'Mozzarella cheese' . PHP_EOL . 'Pepperoni' . PHP_EOL . 'Bell peppers' . PHP_EOL . 'Mushrooms',
                'likes' => json_encode([rand(100, 999), rand(100, 999), rand(100, 999), rand(100, 999), rand(100, 999)]),
                'prep_time' => '23:59:00',
                'cook_time' => '00:15:00',
                'servings' => 8,
                'public' => true,
                'image' => 'pizza.jpg',
            ],
            [
                'title' => 'Tacos',
                'instructions' => 'Tacos with seasoned chicken, salsa, and guacamole. These tacos are packed with flavor and perfect for a Mexican fiesta.',
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
                'ingredients' => 'Tortillas' . PHP_EOL . 'Chicken' . PHP_EOL . 'Salsa' . PHP_EOL . 'Guacamole' . PHP_EOL . 'Lettuce' . PHP_EOL . 'Tomatoes',
                'likes' => json_encode([rand(100, 999), rand(100, 999), rand(100, 999), rand(100, 999)]),
                'prep_time' => '03:17:00',
                'cook_time' => '01:30:00',
                'servings' => 3,
                'public' => true,
                'image' => 'taco.jpg',
            ],
            [
                'title' => 'Lasagne',
                'instructions' => 'Lasagne with layers of pasta, meat sauce, and cheese. This hearty Italian dish is a crowd-pleaser.',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'ingredients' => 'Lasagne noodles' . PHP_EOL . 'Ground beef' . PHP_EOL . 'Tomato sauce' . PHP_EOL . 'Ricotta cheese' . PHP_EOL . 'Mozzarella cheese' . PHP_EOL . 'Parmesan cheese',
                'likes' => json_encode([rand(100, 999), rand(100, 999), rand(100, 999), rand(100, 999), rand(100, 999)]),
                'prep_time' => '04:00:00',
                'cook_time' => '02:00:00',
                'servings' => 2,
                'public' => true,
                'image' => 'lasagna.jpg',
            ],
            [
                'title' => 'Burger',
                'instructions' => 'Burger with beef patty, cheese, and toppings. This juicy burger is perfect for a backyard barbecue.',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'ingredients' => 'Burger buns' . PHP_EOL . 'Beef patty' . PHP_EOL . 'Cheese' . PHP_EOL . 'Lettuce' . PHP_EOL . 'Tomato' . PHP_EOL . 'Onion',
                'likes' => json_encode([rand(100, 999), rand(100, 999), rand(100, 999)]),
                'prep_time' => '00:30:00',
                'cook_time' => '00:30:00',
                'servings' => 1,
                'public' => true,
                'image' => 'burger.jpg',

            ],
            [
                'title' => 'Hot Dog',
                'instructions' => 'Hot Dog with sausage, mustard, and ketchup. This classic American street food is a quick and tasty meal.',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'ingredients' => 'Hot dog buns' . PHP_EOL . 'Sausage' . PHP_EOL . 'Mustard' . PHP_EOL . 'Ketchup' . PHP_EOL . 'Relish',
                'likes' => json_encode([]),
                'prep_time' => '00:50:00',
                'cook_time' => '00:50:00',
                'servings' => 1,
                'public' => true,
                'image' => 'hotdog.jpg',
            ],
        ]);
    }
}
