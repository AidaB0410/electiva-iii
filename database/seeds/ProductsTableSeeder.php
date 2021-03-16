<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
    		['id' => 1, 'image' => 'pizza-1.jpg', 'name' => 'Pizza Napolitana', 'slug' => 'pizza-napolitana', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 2, 'image' => 'pizza-2.jpg', 'name' => 'Pizza de Queso', 'slug' => 'pizza-de-queso', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 3, 'image' => 'pizza-3.jpg', 'name' => 'Pizza de Jamón', 'slug' => 'pizza-de-jamon', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 4, 'image' => 'pizza-4.jpg', 'name' => 'Pizza de Piña', 'slug' => 'pizza-de-pina', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 5, 'image' => 'pizza-5.jpg', 'name' => 'Pizza de Mariscos', 'slug' => 'pizza-de-mariscos', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 6, 'image' => 'pizza-6.jpg', 'name' => 'Pizza Especial', 'slug' => 'pizza-especial', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 7, 'image' => 'pizza-7.jpg', 'name' => 'Pizza Vegetariana', 'slug' => 'pizza-vegetariana', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 8, 'image' => 'pizza-8.jpg', 'name' => 'Pizza de Carne', 'slug' => 'pizza-de-carne', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1]
    	];
    	DB::table('products')->insert($products);
    }
}
