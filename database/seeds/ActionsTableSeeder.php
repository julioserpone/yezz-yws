<?php

/**
 * Akkar Global Services - Actions Workshops Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\Action;
use App\ActionState;
use App\State;
use Illuminate\Database\Seeder;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = [
            ["code" => "software_update", 
                "name_es" => "ACTUALIZACION DE SOFTWARE", "name_en" => "SOFTWARE UPDATE",
                "states" => ["spare_part_not_available",  "repaired"],
            ],
            ["code" => "apn_setup", 
                "name_es" => "CONFIGURACION DE APN", "name_en" => "APN SETUP",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "antenna_replaced", 
                "name_es" => "CAMBIO DE ANTENA", "name_en" => "ANTENNA REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "earphones_replaced", 
                "name_es" => "CAMBIO DE AUDIFONOS", "name_en" => "EARPHONES REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "earpiece_replaced", 
                "name_es" => "CAMBIO DE AURICULAR", "name_en" => "EARPIECE REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "battery_replaced", 
                "name_es" => "CAMBIO DE BATERIA", "name_en" => "BATTERY REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "power_button_replaced", 
                "name_es" => "CAMBIO DE BOTON DE ENCENDIDO", "name_en" => "POWER BUTTON REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "volume_button_replaced", 
                "name_es" => "CAMBIO DE BOTON DE VOLUMEN", "name_en" => "VOLUME BUTTON REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "usb_cable_replaced", 
                "name_es" => "CAMBIO DE CABLE USB", "name_en" => "USB CABLE REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "camera_replaced", 
                "name_es" => "CAMBIO DE CAMARA", "name_en" => "CAMERA REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "charger_replaced", 
                "name_es" => "CAMBIO DE CARGADOR", "name_en" => "CHARGER REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "charging_connector_replaced", 
                "name_es" => "CAMBIO DE CONECTOR DE CARGA", "name_en" => "CHARGING CONNECTOR REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "speaker_replaced", 
                "name_es" => "CAMBIO DE CORNETA", "name_en" => "SPEAKER REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "earphone_jack_replaced", 
                "name_es" => "CAMBIO DE ENTRADA DE AUDIFONOS", "name_en" => "EARPHONE JACK REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "flash_replaced", 
                "name_es" => "CAMBIO DE FLASH", "name_en" => "FLASH REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "led_replaced", 
                "name_es" => "CAMBIO DE LED", "name_en" => "LED REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "flashlight_replaced", 
                "name_es" => "CAMBIO DE LINTERNA", "name_en" => "FLASHLIGHT REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "microphone_replaced", 
                "name_es" => "CAMBIO DE MICROFONO", "name_en" => "MICROPHONE REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "lcd screen_replaced", 
                "name_es" => "CAMBIO DE PANTALLA LCD", "name_en" => "LCD SCREEN REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "sim_port_replaced", 
                "name_es" => "CAMBIO DE PUERTO SIM CARD", "name_en" => "SIM PORT REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "micro_sd_port_replaced", 
                "name_es" => "CAMBIO DE PUERTO TARJETA SD", "name_en" => "MICRO SD PORT REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "proximity_sensor_replaced", 
                "name_es" => "CAMBIO DE SENSOR DE PROXIMIDAD", "name_en" => "PROXIMITY SENSOR REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "touch_screen_replaced", 
                "name_es" => "CAMBIO DE PANTALLA TACTIL", "name_en" => "TOUCH SCREEN REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "pcba_replaced", 
                "name_es" => "CAMBIO DE TARJETA LOGICA", "name_en" => "PCBA REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "keyboard_replaced", 
                "name_es" => "CAMBIO DE TECLADO", "name_en" => "KEYBOARD REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "vibrator_replaced", 
                "name_es" => "CAMBIO DE VIBRADOR", "name_en" => "VIBRATOR REPLACED",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "welding", 
                "name_es" => "RESOLDADURA", "name_en" => "WELDING",
                "states" => ["spare_part_not_available", "repaired"],
            ],
            ["code" => "restored_imei", 
                "name_es" => "RESTAURACION DE IMEI", "name_en" => "RESTORED IMEI",
                "states" => ["spare_part_not_available", "repaired"],
            ],
        ];

        foreach ($actions as $item) {
            $action = Action::create([
                'code' => $item['code'],
                'en'  => ['name' => $item['name_en']],
                'es'  => ['name' => $item['name_es']]
            ]);

            foreach ($item['states'] as $key => $value) {
                ActionState::create([
                    'action_id' => $action->id,
                    'state_id' => State::where('code', $value)->select('id')->first()->id,
                ]);
            }
        }
    }
}
