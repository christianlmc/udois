<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Usuario;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha');
            $table->boolean('admin');
            $table->string('foto_perfil', 255)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $admin = [
            ['nome' => 'admin', 'email' => 'eder@powermidia.net', 'senha' => Hash::make('123@Mudar'), 'admin' => true]
        ];

        Usuario::insert($admin);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
