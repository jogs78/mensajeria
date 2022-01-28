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
            $table->string('foto_perfil',600)->nullable();
            $table->string('correo',50);
            $table->string('password',1000);
            $table->string('rol',50);
            $table->string('puesto', 100);
            $table->string('quien_revisa',100);
            $table->string('remember_token',1000)->nullable();
            $table->boolean('confirmed')->nullable()->default(0);
            $table->string('confirmation_code')->nullable();
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
