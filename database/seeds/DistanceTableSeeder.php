<?php

use Illuminate\Database\Seeder;

class DistanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $distance = [
    		['id' => 1, 'km' => 0.0, 'price' => 0.00, 'slug' => 'local-gratis'],
    		['id' => 2, 'km' => 3.0, 'price' => 10.00, 'slug' => '3-kilometros'],
    		['id' => 3, 'km' => 5.0, 'price' => 15.00, 'slug' => '5-kilometros']
    	];
    	DB::table('distances')->insert($distance);
    }
}
