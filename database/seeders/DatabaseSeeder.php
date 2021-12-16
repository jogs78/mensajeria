<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\Empleado;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $empleado = new Empleado();
        $empleado->nombre = "Informatico";
        $empleado->apellido_paterno = "Apellido";
        $empleado->apellido_materno= "Apellido";
        $empleado->correo="vlc960157@gmail.com";
        $empleado->password="1234";
        $empleado->rol="Informático";
        $empleado->puesto="puesto 1";
        $empleado->quien_revisa="ggg";
        $empleado->confirmed="1";
        $empleado->save();

        // $carrera = new Carrera();
        // $carrera->name="Ingen. Mecánica";
        // $carrera->logo="storage/logos/ing_mecanica.png";
        // $carrera->save();

        // $carrera2 = new Carrera();
        // $carrera2->name="Ingen. Mecánica";
        // $carrera2->logo="storage/logos/ing_mecanica.png";
        // $carrera2->save();

        // $carrera3 = new Carrera();
        // $carrera3->name="Ingen. Mecánica";
        // $carrera3->logo="storage/logos/ing_mecanica.png";
        // $carrera3->save();

        // $carrera = new Carrera();
        // $carrera->name="Ingen. Mecánica";
        // $carrera->logo="storage/logos/ing_mecanica.png";
        // $carrera->save();

        // $carrera = new Carrera();
        // $carrera->name="Ingen. Mecánica";
        // $carrera->logo="storage/logos/ing_mecanica.png";
        // $carrera->save();

        // $carrera = new Carrera();
        // $carrera->name="Ingen. Mecánica";
        // $carrera->logo="storage/logos/ing_mecanica.png";
        // $carrera->save();

        // $carrera = new Carrera();
        // $carrera->name="Ingen. Mecánica";
        // $carrera->logo="storage/logos/ing_mecanica.png";
        // $carrera->save();

        // $carrera = new Carrera();
        // $carrera->name="Ingen. Mecánica";
        // $carrera->logo="storage/logos/ing_mecanica.png";
        // $carrera->save();

        // $carrera = new Carrera();
        // $carrera->name="Ingen. Mecánica";
        // $carrera->logo="storage/logos/ing_mecanica.png";
        // $carrera->save();

        // $carrera = new Carrera();
        // $carrera->name="Ingen. Mecánica";
        // $carrera->logo="storage/logos/ing_mecanica.png";
        // $carrera->save();

        // $carrera = new Carrera();
        // $carrera->name="Ingen. Mecánica";
        // $carrera->logo="storage/logos/ing_mecanica.png";
        // $carrera->save();
    }
}
