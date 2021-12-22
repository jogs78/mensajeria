<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\Empleado;
use App\Models\Semestre;
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

        $carrera = new Carrera();
        $carrera->name="Ingen. Mecánica";
        $carrera->logo="storage/logos/ing_mecanica.png";
        $carrera->save();

        $carrera2 = new Carrera();
        $carrera2->name="Ingen. Sistemas Computacionales";
        $carrera2->logo="storage/logos/ing_sistemas.png";
        $carrera2->save();

        $carrera3 = new Carrera();
        $carrera3->name="Ingen. Industrial";
        $carrera3->logo="storage/logos/ing_industrial.png";
        $carrera3->save();

        $carrera4 = new Carrera();
        $carrera4->name="Ingen. Electrónica";
        $carrera4->logo="storage/logos/ing_electronica.png";
        $carrera4->save();
        
        $carrera5 = new Carrera();
        $carrera5->name="Ingen. Eléctrica";
        $carrera5->logo="storage/logos/ing_Electrica.png";
        $carrera5->save();

        $carrera6 = new Carrera();
        $carrera6->name="Ingen. Bioquímica";
        $carrera6->logo="storage/logos/ing_Bioquimica.png";
        $carrera6->save();

        $carrera7 = new Carrera();
        $carrera7->name="Ingen. Química";
        $carrera7->logo="storage/logos/ing_quimica.png";
        $carrera7->save();

        $carrera8 = new Carrera();
        $carrera8->name="Ingen. Gestión empresarial";
        $carrera8->logo="storage/logos/ing_gestion.png";
        $carrera8->save();

        $carrera9 = new Carrera();
        $carrera9->name="Ingen. Logística";
        $carrera9->logo="storage/logos/ing_logistica.png";
        $carrera9->save();

        $carrera10 = new Carrera();
        $carrera10->name="Maestría en Ciencias en Ingeniería Bioquímica";
        $carrera10->logo="storage/logos/maestria1.jpg";
        $carrera10->save();

        $carrera11 = new Carrera();
        $carrera11->name="Maestría en Ciencias en Ingeniería Mecatrónica";
        $carrera11->logo="storage/logos/ing_maestria2.jpg";
        $carrera11->save();

        $carrera12 = new Carrera();
        $carrera12->name="Doctorado en Ciencias de los Alimentos y Biotecnología";
        $carrera12->logo="storage/logos/doctorado1.jpg";
        $carrera12->save();

        $carrera13 = new Carrera();
        $carrera13->name="Doctorado en Ciencias de la Ingeniería";
        $carrera13->logo="storage/logos/doctorado2.jpg";
        $carrera13->save();

        $semestre = new Semestre();
        $semestre->semestre="Primer";
        $semestre->save();

        $semestre2 = new Semestre();
        $semestre2->semestre="Segundo";
        $semestre2->save();

        $semestre3 = new Semestre();
        $semestre3->semestre="Tercer";
        $semestre3->save();

        $semestre4 = new Semestre();
        $semestre4->semestre="Cuarto";
        $semestre4->save();

        $semestre5 = new Semestre();
        $semestre5->semestre="Quinto";
        $semestre5->save();

        $semestre6 = new Semestre();
        $semestre6->semestre="Sexto";
        $semestre6->save();

        $semestre7 = new Semestre();
        $semestre7->semestre="Septimo";
        $semestre7->save();

        $semestre8 = new Semestre();
        $semestre8->semestre="Octavo";
        $semestre8->save();

        $semestre9 = new Semestre();
        $semestre9->semestre="Noveno";
        $semestre9->save();


        
        
        
        
        
        
        
        
    }
}
