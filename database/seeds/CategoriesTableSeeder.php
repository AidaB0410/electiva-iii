<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
    		['id' => 1, 'name' => 'Pizzas', 'slug' => 'pizzas'],
    		['id' => 2, 'name' => 'Bebidas', 'slug' => 'bebidas'],
            ['id' => 3, 'name' => 'Promociones', 'slug' => 'promociones']
    	];
    	DB::table('categories')->insert($categories);
    }
}
