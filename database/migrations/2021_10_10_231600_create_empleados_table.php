<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->string('apellido_paterno',50);
            $table->string('apellido_materno',50);
            $table->string('correo',50);
            $table->string('pass',1000);
            $table->enum('rol', ["Alumno", "Emisor", "Revisor", "Difusor", "Informatico"]);
            $table->enum('puesto', ["puesto1","puesto2","puesto3"]);
            $table->string('quien_revisa',100);
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
        Schema::dropIfExists('empleados');
    }
}
