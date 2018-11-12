<?php

/**
 * Akkar Global Services - Couriers Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\Courier;
use App\CourierCountry;
use App\Country;
use Illuminate\Database\Seeder;

class CouriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couriers = array(
            array("code" => "dhl", "description" => "DHL", "country" => array("*")),
            array("code" => "usps", "description" => "USPS", "country" => array("*")),
            array("code" => "zoom", "description" => "ZOOM", "country" => array("VE")),
            array("code" => "tealca", "description" => "TEALCA", "country" => array("*")),
            array("code" => "domesa", "description" => "DOMESA", "country" => array("*")),
            array("code" => "mrw", "description" => "MRW", "country" => array("*"))
        );


        foreach ($couriers as $data) {
            $courier = Courier::create([
                'code' => $data['code'],
                'description' => $data['description'],
            ]);

            foreach ($data['country'] as $countries) {
                if ($countries == "*") {
                    foreach (Country::all() as $country) {
                        CourierCountry::create([
                            "courier_id" => $courier->id,
                            "country_id" => $country->id,
                        ]);
                    }
                } else {
                    CourierCountry::create([
                        "courier_id" => $courier->id,
                        "country_id" => Country::where("iso_code", $countries)->first()->id,
                    ]);
                }
            }
        }
    }
}
