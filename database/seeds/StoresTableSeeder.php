<?php

use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = [
    		['id' => 1, 'image' => 'prado.jpg', 'name' => 'Prado', 'slug' => 'prado', 'address' => 'Av. José Ballivian entre La Paz y Jose de la Reza', 'phone_one' => '4527616', 'phone_two' => '4069996'],
    		['id' => 2, 'image' => 'circunvalacion.jpg', 'name' => 'Circunvalación', 'slug' => 'circunvalacion', 'address' => 'Av. Circunvalación y calle Benjamín Guzmán', 'phone_one' => '4225088', 'phone_two' => NULL]
    	];
    	DB::table('stores')->insert($stores);
    }
}
