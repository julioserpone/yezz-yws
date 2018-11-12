<?php

/**
 * Akkar Global system - Attributes Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 20 - 2016)
 */

use App\Attribute;
use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = array(
            array("code" => "OS_SECUENCE", "name_attribute" => "Secuence Services Order", "type_data" => "integer"),
            array("code" => "TAX", "name_attribute" => "Tax", "type_data" => "double"),
            array("code" => "CONVERSION_RATE", "name_attribute" => "Conversion Rate", "type_data" => "double"),
            array("code" => "NIVEL_REPAIR_I", "name_attribute" => "Nivel Repair I", "type_data" => "double"),
            array("code" => "NIVEL_REPAIR_II", "name_attribute" => "Nivel Repair II", "type_data" => "double"),
        );

        foreach ($attributes as $attribute) {
            Attribute::create([
                'code'           => $attribute['code'],
                'name_attribute' => $attribute['name_attribute'],
                'type_data'      => $attribute['type_data']
            ]);
        }
    }
}
