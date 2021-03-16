<?php

use Illuminate\Database\Seeder;

class ProductstoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productStore = [
    		['id' => 1, 'product_id' => 1, 'store_id' => 1],
    		['id' => 2, 'product_id' => 2, 'store_id' => 1],
    		['id' => 3, 'product_id' => 3, 'store_id' => 1],
    		['id' => 4, 'product_id' => 4, 'store_id' => 1],
    		['id' => 5, 'product_id' => 5, 'store_id' => 1],
    		['id' => 6, 'product_id' => 6, 'store_id' => 1],
    		['id' => 7, 'product_id' => 7, 'store_id' => 1],
    		['id' => 8, 'product_id' => 8, 'store_id' => 1],
    		['id' => 9, 'product_id' => 1, 'store_id' => 2],
    		['id' => 10, 'product_id' => 2, 'store_id' => 2]
    	];
    	DB::table('product_store')->insert($productStore);
    }
}
