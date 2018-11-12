<?php

/**
 * Akkar Global system - Countries Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 20 - 2016)
 */

use App\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_path = "/data/mysql/";

        //Preload of countries
        DB::unprepared(file_get_contents(realpath(__DIR__ . $data_path . 'countries.sql')));

        $countries = array(
            array("description" => "VENEZUELA", "iso_code" => "VE", "calling_code" => "+58", "coin_code" => "Bsf","coin_name" => "BOLIVAR FUERTE", "language" => "es"),
            array("description" => "COLOMBIA", "iso_code" => "CO", "calling_code" => "+57", "coin_code" => "COP", "coin_name" => "PESO", "language" => "es"),
            array("description" => "MEXICO", "iso_code" => "MX", "calling_code" => "+52", "coin_code" => "MXN", "coin_name" => "PESO", "language" => "es"),
            array("description" => "URUGUAY", "iso_code" => "UY", "calling_code" => "+598", "coin_code" => "UYU", "coin_name" => "PESO", "language" => "es"),
            array("description" => "UNITED STATES", "iso_code" => "US", "calling_code" => "+1", "coin_code" => "USD", "coin_name" => "DOLLAR", "language" => "en"),
            array("description" => "PERU", "iso_code" => "PE", "calling_code" => "+51", "coin_code" => "PEN", "coin_name" => "SOL", "language" => "es"),
            array("description" => "GUATEMALA", "iso_code" => "GT", "calling_code" => "+502", "coin_code" => "GTQ", "coin_name" => "QUETZAL", "language" => "es"),
            array("description" => "COSTA RICA", "iso_code" => "CR", "calling_code" => "+506", "coin_code" => "CRC", "coin_name" => "COLON", "language" => "es"),
            array("description" => "NICARAGUA", "iso_code" => "NI", "calling_code" => "+505", "coin_code" => "NIO", "coin_name" => "CORDOBA", "language" => "es"),
            array("description" => "PANAMA", "iso_code" => "PA", "calling_code" => "+507", "coin_code" => "PAB", "coin_name" => "BALBOA", "language" => "es"),
            array("description" => "HONDURAS", "iso_code" => "HN", "calling_code" => "+504", "coin_code" => "HNL", "coin_name" => "LEMPIRA", "language" => "es"),
            array("description" => "ECUADOR", "iso_code" => "EC", "calling_code" => "+593", "coin_code" => "USD", "coin_name" => "DOLLAR", "language" => "es"),
            array("description" => "EL SALVADOR", "iso_code" => "SV", "calling_code" => "+503", "coin_code" => "USD", "coin_name" => "DOLLAR", "language" => "es"),
        );


        //Update parametros de los paises donde tenemos presencia de la marca
        foreach ($countries as $data) {
            $country = Country::where('iso_code', $data['iso_code'])->first();
            $country->calling_code = $data['calling_code'];
            $country->coin_code = $data['coin_code'];
            $country->coin_name = $data['coin_name'];
            $country->language = $data['language'];
            $country->update();
            /*Country::create([
                'description'  => $data['description'],
                'iso_code'     => $data['iso_code'],
                'calling_code' => $data['calling_code'],
                'coin_code'    => $data['coin_code'],
                'coin_name'    => $data['coin_name'],
                'language'     => $data['language'],
            ]);*/
        }
    }
}
