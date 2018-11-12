<?php

/**
 * Akkar Global Services - Failures Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Julio 04 - 2016)
 */

use App\Failure;
use Illuminate\Database\Seeder;

class FailuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $failures = array(
            array("code" => "NO LIGHTS", "name_es" => "NO ENCIENDE", "name_en" => "NO LIGHTS"),
            array("code" => "NO CHARGE", "name_es" => "NO CARGA", "name_en" => "NO CHARGE"),
            array("code" => "NOT CONNECT WIFI", "name_es" => "NO CONECTA WIFI", "name_en" => "NOT CONNECT WIFI"),
            array("code" => "SCREEN WITHOUT IMAGE AND/OR DAMAGED", "name_es" => "PANTALLA SIN IMAGEN Y/O DAÑADA ", "name_en" => "SCREEN WITHOUT IMAGE AND/OR DAMAGED"),
            array("code" => "DO NOT LISTEN", "name_es" => "NO SE ESCUCHA", "name_en" => "DO NOT LISTEN"),
            array("code" => "DAMAGED VOLUME BUTTON", "name_es" => "BOTON VOLUMEN DAÑADO", "name_en" => "DAMAGED VOLUME BUTTON"),
            array("code" => "DOES NOT RECOGNIZE SIMCARD", "name_es" => "NO RECONOCE SIMCARD", "name_en" => "DOES NOT RECOGNIZE SIMCARD"),
            array("code" => "IT DOES NOT WORK AND/OR REAR FACING CAMERA", "name_es" => "NO FUNCIONA LA CAMARA FRONTAL Y/O TRASERA", "name_en" => "IT DOES NOT WORK AND/OR REAR FACING CAMERA"),
            array("code" => "FLASH DOES NOT WORK", "name_es" => "NO FUNCIONA FLASH", "name_en" => "FLASH DOES NOT WORK"),
            array("code" => "BUTTON ON DAMAGED", "name_es" => "BOTON ENCENDIDO DAÑADO", "name_en" => "BUTTON ON DAMAGED"),
            array("code" => "DO NOT READ MICRO SD MEMORY", "name_es" => "NO LEE MEMORIA MICRO SD", "name_en" => "DO NOT READ MICRO SD MEMORY"),
            array("code" => "NO POWER TO END THE CALL SCREEN", "name_es" => "NO ENCIENDE PANTALLA AL FINALIZAR LA LLAMADA", "name_en" => "NO POWER TO END THE CALL SCREEN"),
            array("code" => "THE PHONE OVERHEATS", "name_es" => "EL TELEFONO SE RECALIENTA", "name_en" => "THE PHONE OVERHEATS"),
            array("code" => "IT STAYS IN THE LOGO", "name_es" => "SE QUEDA EN EL LOGO", "name_en" => "IT STAYS IN THE LOGO"),
            array("code" => "IT TURNS OFF BY ITSELF", "name_es" => "SE APAGA SOLO", "name_en" => "IT TURNS OFF BY ITSELF"),
            array("code" => "DOES NOT START THE DEFAULT APPLICATION ON THE COMPUTER", "name_es" => "NO INICIA LA APLICACION POR DEFECTO EN EL EQUIPO", "name_en" => "DOES NOT START THE DEFAULT APPLICATION ON THE COMPUTER"),
            array("code" => "THE KEYBOARD DOES NOT WORK", "name_es" => "NO FUNCIONA EL TECLADO", "name_en" => "THE KEYBOARD DOES NOT WORK"),
            array("code" => "MALFUNCTIONING MICROPHONE", "name_es" => "MAL FUNCIONAMIENTO DE MICROFONO", "name_en" => "MALFUNCTIONING MICROPHONE"),
            array("code" => "VIBRATOR", "name_es" => "VIBRADOR", "name_en" => "VIBRATOR"),
            array("code" => "TACTILE", "name_es" => "TACTIL", "name_en" => "TACTILE"),
            array("code" => "ACCESSORY NOT WORKING", "name_es" => "ACCESORIO NO FUNCIONA", "name_en" => "ACCESSORY NOT WORKING"),
            array("code" => "VIRUS", "name_es" => "VIRUS", "name_en" => "VIRUS"),
            array("code" => "OTHERS", "name_es" => "OTROS", "name_en" => "OTHERS"),
        );

        foreach ($failures as $failure) {
            Failure::create([
                'code' => $failure['code'],
                'en'  => ['name' => $failure['name_en']],
                'es'  => ['name' => $failure['name_es']]
            ]);
        }
    }
}
