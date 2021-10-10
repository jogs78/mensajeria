<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_control');
            $table->string('nombre', 100);
            $table->string('apellido_paterno',50);
            $table->string('apellido_materno',50);
            $table->string('carrera',50);
            $table->integer('semestre');
            $table->string('correo',50);
            $table->string('contraseña',500);
            $table->string('foto_perfil',1000)->nullable();
            $table->timestamps();//created_up updated_up////
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
