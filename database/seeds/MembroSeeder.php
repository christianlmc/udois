<?php

use Illuminate\Database\Seeder;

use Udois\Membro;

class MembroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $membro = [
            ['usuario_id' => 2, 'sala_id' => 1],
            ['usuario_id' => 1, 'sala_id' => 1]
        ];

        Membro::insert($membro);
    }
}
