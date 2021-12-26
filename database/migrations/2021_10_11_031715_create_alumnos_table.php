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
            $table->integer('id')->primary();
            $table->string('nombre', 100);
            $table->string('apellido_paterno',50);
            $table->string('apellido_materno',50);
            $table->string('correo',50);
            $table->string('contraseña',500);
            $table->string('foto_perfil',1000)->nullable();
            //llaves foraneas
            $table->unsignedBigInteger('carrera_id');
            $table->unsignedBigInteger('semestre_id');
            $table->foreign('carrera_id')
                    ->references('id')->on('carreras');

            $table->foreign('semestre_id')
                    ->references('id')->on('semestres');

            $table->string('remember_token',1000)->nullable();
            $table->boolean('confirmed')->nullable()->default(0);
            $table->string('confirmation_code')->nullable();
            $table->integer('segmentacion')->nullable();        
            $table->timestamps();//created_up updated_up
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
