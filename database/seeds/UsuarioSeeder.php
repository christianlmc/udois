<?php

use Illuminate\Database\Seeder;

use Udois\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$usuario = [
            ['nome' => 'Christian Luis', 'email' => 'christianlmc1@gmail.com', 'senha' => Hash::make('123123'), 'admin' => false]
        ];

        Usuario::insert($usuario);

        $this->call([
	        SalaSeeder::class,
	    ]);
    }
}
