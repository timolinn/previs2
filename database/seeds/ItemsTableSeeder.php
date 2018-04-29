<?php

use Illuminate\Database\Seeder;
use Previs\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = Item::create([
            'item_name' => 'Goat Meat',
            'number_in_stock' => 50,
            'item_category' => 'food',
            'item_price' => 3000,
            'description' => "Delicious Healthy goat meat",
            'slug' => strtolower('Goat-Meat'),
            'image_path' => 'assets\imgs\goat2.jpg'
        ]);

        $item = Item::create([
            'item_name' => 'Roasted Chicked',
            'number_in_stock' => 50,
            'item_category' => 'food',
            'item_price' => 2000,
            'description' => "Delicious Healthy Roasted Chicked",
            'slug' => strtolower('Roasted-Chicked'),
            'image_path' => 'assets\imgs\chicken_plate.jfif'
        ]);

        $item = Item::create([
            'item_name' => 'eggs',
            'number_in_stock' => 50,
            'item_category' => 'food',
            'item_price' => 300,
            'description' => "Delicious Healthy eggs",
            'slug' => strtolower('eggs'),
            'image_path' => 'assets\imgs\eggsnew.jfif'
        ]);
    }
}
