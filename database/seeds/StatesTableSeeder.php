<?php

/**
 * Akkar Global Services - States Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\State;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ["code" => "issued_case", "name_es" => "CASO EMITIDO", "name_en" => "ISSUED CASE", "close_order" => false, "roles" => "{}"],
            ["code" => "out_of_time", "name_es" => "FUERA DE TIEMPO", "name_en" => "OUT OF TIME", "close_order" => true, "roles" => "{}"],
            ["code" => "received", "name_es" => "RECIBIDO EN TALLER", "name_en" => "RECEIVED BY SERVICE CENTER", "close_order" => false, "roles" => "{}"],
            ["code" => "voided", "name_es" => "NULA", "name_en" => "VOIDED", "close_order" => true, "roles" => "{}"],
            ["code" => "swap", "name_es" => "CAMBIADO", "name_en" => "SWAP", "close_order" => false, "roles" => "{}"],
            ["code" => "delivered", "name_es" => "ENTREGADO AL CLIENTE", "name_en" => "DELIVERED TO CLIENT", "close_order" => true, "roles" => "{}"],
            ["code" => "sent_by_workshop", "name_es" => "ENVIADO POR EL TALLER", "name_en" => "SENT BY SERVICE CENTER", "close_order" => false, "roles" => "{}"],
            ["code" => "failure_not_detected", "name_es" => "NO PRESENTA FALLA", "name_en" => "FAILURE NOT DETECTED", "close_order" => false, "roles" => "{}"],
            ["code" => "credit_note", "name_es" => "NOTA DE CREDITO", "name_en" => "CREDIT NOTE", "close_order" => true, "roles" => "{}"],

            ["code" => "spare_part_not_available", "name_es" => "COMPONENTE NO DISPONIBLE", "name_en" => "SPARE PART NOT AVAILABLE", "close_order" => false, "roles" => "{}"],
            ["code" => "cannot_be_repaired", "name_es" => "NO SE PUEDE REPARAR", "name_en" => "CANNOT BE REPAIRED", "close_order" => false, "roles" => "{}"],
            ["code" => "pending_client_approval", "name_es" => "PENDIENTE APROBACION DEL CLIENTE", "name_en" => "PENDING CLIENT APPROVAL", "close_order" => false, "roles" => "{}"],
            ["code" => "repaired", "name_es" => "REPARADO", "name_en" => "REPAIRED", "close_order" => false, "roles" => "{}"],

            //Estados eliminados segun correo del 23/08/2017
            //["code" => "sent", "name_es" => "ENVIADO AL TALLER", "name_en" => "SENT TO SERVICE CENTER"],
            //["code" => "under_review", "name_es" => "EN REVISION", "name_en" => "UNDER REVIEW"],
            //["code" => "not_approved_by_client", "name_es" => "NO APROBADO POR EL CLIENTE", "name_en" => "NOT APPROVED BY CLIENT"],
            //["code" => "approved_by_client", "name_es" => "APROBADO POR EL CLIENTE", "name_en" => "APPROVED BY CLIENT"],
            //["code" => "abandoned", "name_es" => "ABANDONADO", "name_en" => "ABANDONED"],
        ];

        foreach ($states as $state) {
            State::create([
                'code' => $state['code'],
                'close_order' => $state['close_order'],
                'roles' => $state['roles'],
                'en'  => ['name' => $state['name_en']],
                'es'  => ['name' => $state['name_es']]
            ]);
        }
    }
}
