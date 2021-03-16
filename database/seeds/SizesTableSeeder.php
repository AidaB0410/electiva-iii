<?php

use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
    		['id' => 1, 'name' => 'Normal', 'slug' => 'normal'],
            ['id' => 2, 'name' => 'Pequeña', 'slug' => 'pequena'],
    		['id' => 3, 'name' => 'Madiana', 'slug' => 'mediana'],
    		['id' => 4, 'name' => 'Grande', 'slug' => 'grande'],
    		['id' => 5, 'name' => 'Familiar', 'slug' => 'familiar'],
            ['id' => 6, 'name' => 'Super', 'slug' => 'super'],
            ['id' => 7, 'name' => 'Mega Pizza', 'slug' => 'mega-pizza'],
            ['id' => 8, 'name' => 'Gigante', 'slug' => 'gigante'],
            ['id' => 9, 'name' => 'Super Gigante', 'slug' => 'super-gigante']
    	];
    	DB::table('sizes')->insert($sizes);
    }
}
