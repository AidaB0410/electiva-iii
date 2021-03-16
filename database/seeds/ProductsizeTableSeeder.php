<?php

use Illuminate\Database\Seeder;

class ProductsizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productSize = [
    		['id' => 1, 'product_id' => 1, 'size_id' => 8, 'price' => 4.5],
    		['id' => 2, 'product_id' => 1, 'size_id' => 2, 'price' => 6.0],
    		['id' => 3, 'product_id' => 1, 'size_id' => 3, 'price' => 7.5],
    		['id' => 4, 'product_id' => 1, 'size_id' => 4, 'price' => 8.5],
    		['id' => 5, 'product_id' => 2, 'size_id' => 8, 'price' => 5.0],
    		['id' => 6, 'product_id' => 2, 'size_id' => 2, 'price' => 7.5],
    		['id' => 7, 'product_id' => 2, 'size_id' => 3, 'price' => 9.5],
    		['id' => 8, 'product_id' => 2, 'size_id' => 4, 'price' => 11.5],
    		['id' => 9, 'product_id' => 3, 'size_id' => 8, 'price' => 4.5],
    		['id' => 10, 'product_id' => 3, 'size_id' => 2, 'price' => 6.5],
    		['id' => 11, 'product_id' => 3, 'size_id' => 3, 'price' => 9.5],
    		['id' => 12, 'product_id' => 3, 'size_id' => 4, 'price' => 15.5],
    		['id' => 13, 'product_id' => 4, 'size_id' => 8, 'price' => 4.5],
    		['id' => 14, 'product_id' => 4, 'size_id' => 2, 'price' => 8.5],
    		['id' => 15, 'product_id' => 4, 'size_id' => 3, 'price' => 12.5],
    		['id' => 16, 'product_id' => 4, 'size_id' => 4, 'price' => 18.5],
    		['id' => 17, 'product_id' => 5, 'size_id' => 8, 'price' => 4.5],
    		['id' => 18, 'product_id' => 5, 'size_id' => 2, 'price' => 8.5],
    		['id' => 19, 'product_id' => 5, 'size_id' => 3, 'price' => 10.5],
    		['id' => 20, 'product_id' => 5, 'size_id' => 4, 'price' => 12.5],
    		['id' => 21, 'product_id' => 6, 'size_id' => 8, 'price' => 6.5],
    		['id' => 22, 'product_id' => 6, 'size_id' => 2, 'price' => 12.5],
    		['id' => 23, 'product_id' => 6, 'size_id' => 3, 'price' => 17.5],
    		['id' => 24, 'product_id' => 6, 'size_id' => 4, 'price' => 20.5],
    		['id' => 25, 'product_id' => 7, 'size_id' => 8, 'price' => 9.5],
    		['id' => 26, 'product_id' => 7, 'size_id' => 2, 'price' => 15.5],
    		['id' => 27, 'product_id' => 7, 'size_id' => 3, 'price' => 20.5],
    		['id' => 28, 'product_id' => 7, 'size_id' => 4, 'price' => 22.5],
    		['id' => 29, 'product_id' => 8, 'size_id' => 1, 'price' => 8.7]
    	];
    	DB::table('product_size')->insert($productSize);
    }
}
