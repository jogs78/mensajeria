<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarreraMensajeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrera_mensaje', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('carrera_id');
            $table->unsignedBigInteger('mensaje_id');

            $table->foreign('carrera_id')
                    ->references('id')->on('carreras')->onDelete('cascade');
            $table->foreign('mensaje_id')
                    ->references('id')->on('mensajes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrera_mensaje');
    }
}
