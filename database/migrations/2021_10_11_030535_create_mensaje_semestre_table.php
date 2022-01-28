<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajeSemestreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensaje_semestre', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('mensaje_id');
            $table->unsignedBigInteger('semestre_id');

            $table->foreign('mensaje_id')
                    ->references('id')->on('mensajes')->onDelete('cascade');
            $table->foreign('semestre_id')
                    ->references('id')->on('semestres')->onDelete('cascade');

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
        Schema::dropIfExists('mensaje_semestre');
    }
}
