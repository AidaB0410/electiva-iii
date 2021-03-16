<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SizesTableSeeder::class);
        $this->call(StoresTableSeeder::class);
    	$this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductsizeTableSeeder::class);
        $this->call(ProductstoreTableSeeder::class);
        $this->call(DistanceTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
    }
}
