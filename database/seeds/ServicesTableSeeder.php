<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
    		['id' => 1, 'image' => 'imagen.jpg', 'title' => 'Delivery', 'slug' => 'delivery', 'description' => 'Reparto a domicilio con red, mediante compra o efectivo todos lo días.', 'state' => '1'],
    		['id' => 2, 'image' => 'imagen.jpg', 'title' => 'Reservas', 'slug' => 'reservas', 'description' => 'Puedes reservar mesas telefónicamente o realizar tu pedido y pasar a recogerlo.', 'state' => '1'],
    		['id' => 3, 'image' => 'imagen.jpg', 'title' => 'Pedidos', 'slug' => 'pedidos', 'description' => '¿Problemas con tu pedido? Comunicate con el jefe del local, click aquí.', 'state' => '1'],
    		['id' => 4, 'image' => 'imagen.jpg', 'title' => 'Menú Especial', 'slug' => 'menu-especial', 'description' => 'Ven y disfruta de nuestro menú, todos los días tenemos almuerzo completo.', 'state' => '1'],
    		['id' => 5, 'image' => 'imagen.jpg', 'title' => 'Horarios Prado', 'slug' => 'horarios-prado', 'description' => 'Lunes a domingo: de 12:00h a 24:00h. Teléfonos: 72204591 - 76971781', 'state' => '1'],
    		['id' => 6, 'image' => 'imagen.jpg', 'title' => 'Horarios Circunvalación', 'slug' => 'horarios-circunvalacion', 'description' => 'Lunes a domingo: de 17:30h a 23:00h. Teléfonos: 72204591 - 76971781', 'state' => '1']
    	];
    	DB::table('services')->insert($services);
    }
}
