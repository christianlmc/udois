<?php

use Illuminate\Database\Seeder;

use Udois\Sala;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sala = [
            ['nome' => null, 'foto_sala' => null]
        ];

        Sala::insert($sala);

    }
}
