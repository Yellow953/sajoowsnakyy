<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $restaurant_categories = [
            ['Main Dish', 'A selection of hearty and satisfying meals, including steaks, grilled chicken, pasta, and more.', 'assets/images/dish.png'],
            ['Fries', 'Crispy, golden fries served plain or with delicious toppings and seasonings.', 'assets/images/fries.png'],
            ['Burgers', 'Juicy and flavorful burgers with a variety of toppings, served on a soft bun.', 'assets/images/hamburger.png'],
            ['Deserts', 'Indulge in a variety of sweet treats, including cakes, ice cream, pastries, and more.', 'assets/images/icecream.png'],
            ['Pizza', 'Delicious, freshly baked pizzas with a variety of toppings and crust options.', 'assets/images/pizza.png'],
            ['Salads', 'Fresh and healthy salads made with crisp greens, vegetables, proteins, and flavorful dressings.', 'assets/images/salads.png'],
            ['Sandwich', 'Tasty sandwiches filled with fresh ingredients, served hot or cold.', 'assets/images/sandwish.png'],
            ['Starters', 'Appetizing small plates to start your meal, including soups, dips, and finger foods.', 'assets/images/starters.png'],
            ['Platters', 'Generous portions of meat, seafood, or mixed items served with sides for a fulfilling meal.', 'assets/images/steak.png'],
            ['Tacos', 'Authentic and flavorful tacos filled with meats, veggies, and tasty toppings.', 'assets/images/tacos.png'],
            ['Others', 'Everything else...', 'assets/images/other.png'],
            ['Favorite', 'Favorite Items...', 'assets/images/favorite.png'],
        ];

        foreach ($restaurant_categories as $category) {
            DB::table('categories')->insert([
                'name' => $category[0],
                'description' => $category[1],
                'image' => $category[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
