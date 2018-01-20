<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('texto');

            $table->integer('usuario_id')->unsigned();
            $table->integer('sala_id')->unsigned();
            $table->foreign(['usuario_id', 'sala_id'])->references(['usuario_id', 'sala_id'])->on('membros');
            $table->timestamp('hora_enviado');
            $table->timestamp('hora_visualizado')->nullable();
            $table->boolean('arquivo');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `udois`.`mensagens` 
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id`, `sala_id`, `usuario_id`);");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensagens');
    }
}
