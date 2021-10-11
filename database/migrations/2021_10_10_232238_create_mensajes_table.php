<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();      
            $table->string('titulo');
            $table->text('descripcion');
            $table->integer('estado');
            $table->string('imagen',600);

            //llave foranea
            $table->unsignedBigInteger('empleado_id');

            $table->foreign('empleado_id')
                    ->references('id')->on('empleados');
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
        Schema::dropIfExists('mensajes');
    }
}