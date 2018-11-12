<?php

/**
 * Akkar Global Services - Countries Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 20 - 2016)
 */

use App\Country;
use App\Province;
use App\City;
use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Preload of provinces
        $data_path = "/data/mysql/";

        DB::unprepared(file_get_contents(realpath(__DIR__ . $data_path . 'states.sql')));
        DB::unprepared(file_get_contents(realpath(__DIR__ . $data_path . 'cities.sql')));

        //Rutina para eliminar las provincias y ciudades de los paises que no vamos a utilizar
        $countries = Country::select(['id'])->whereIn('iso_code', trans('globals.countries_yezz'))->orderBy('description')->get();
        $provinces_to_delete = Province::select(['id'])->whereNotIn('country_id', $countries)->get();
        $cities_deleted = City::whereIn('province_id', $provinces_to_delete)->forceDelete();
        Province::whereNotIn('country_id', $countries)->forceDelete();
        Country::whereNotIn('iso_code', trans('globals.countries_yezz'))->forceDelete();

        //Zonas horarias
        $timezones = [
            "US" => [
                "america/anchorage" => [
                    ["iso_code" => "AK", "description" => "Alaska"],
                ],
                "america/chicago" => [
                    ["iso_code" => "AL", "description" => "Alabama"],
                    ["iso_code" => "IL", "description" => "Illinois"],
                    ["iso_code" => "IA", "description" => "Iowa"],
                    ["iso_code" => "KS", "description" => "Kansas"],
                    ["iso_code" => "LA", "description" => "Louisiana"],
                    ["iso_code" => "MN", "description" => "Minnesota"],
                    ["iso_code" => "MS", "description" => "Mississippi"],
                    ["iso_code" => "MO", "description" => "Missouri"],
                    ["iso_code" => "NE", "description" => "Nebraska"],
                    ["iso_code" => "ND", "description" => "North Dakota"],
                    ["iso_code" => "OK", "description" => "Oklahoma"],
                    ["iso_code" => "SD", "description" => "South Dakota"],
                    ["iso_code" => "TN", "description" => "Tennessee"],
                    ["iso_code" => "TX", "description" => "Texas"],
                    ["iso_code" => "WI", "description" => "Wisconsin"],
                ],
                "america/new_york" => [
                    ["iso_code" => "CT", "description" => "Connecticut"],
                    ["iso_code" => "DE", "description" => "Delaware"],
                    ["iso_code" => "FL", "description" => "Florida"],
                    ["iso_code" => "GA", "description" => "Georgia"],
                    ["iso_code" => "IN", "description" => "Indiana"],
                    ["iso_code" => "KY", "description" => "Kentucky"],
                    ["iso_code" => "ME", "description" => "Maine"],
                    ["iso_code" => "MD", "description" => "Maryland"],
                    ["iso_code" => "MA", "description" => "Massachusetts"],
                    ["iso_code" => "MI", "description" => "Michigan"],
                    ["iso_code" => "NH", "description" => "New Hampshire"],
                    ["iso_code" => "NJ", "description" => "New Jersey"],
                    ["iso_code" => "NY", "description" => "New York"],
                    ["iso_code" => "NC", "description" => "North Carolina"],
                    ["iso_code" => "OH", "description" => "Ohio"],
                    ["iso_code" => "PA", "description" => "Pennsylvania"],
                    ["iso_code" => "RI", "description" => "Rhode Island"],
                    ["iso_code" => "SC", "description" => "South Carolina"],
                    ["iso_code" => "VT", "description" => "Vermont"],
                    ["iso_code" => "VA", "description" => "Virginia"],
                    ["iso_code" => "WV", "description" => "West Virginia"],
                ],
                "america/denver" => [
                    ["iso_code" => "CO", "description" => "Colorado"],
                    ["iso_code" => "ID", "description" => "Idaho"],
                    ["iso_code" => "MT", "description" => "Montana"],
                    ["iso_code" => "NM", "description" => "New Mexico"],
                    ["iso_code" => "UT", "description" => "Utah"],
                    ["iso_code" => "WY", "description" => "Wyoming"],
                ],
                "america/phoenix" => [
                    ["iso_code" => "AZ", "description" => "Arizona"],
                    ["iso_code" => "AR", "description" => "Arkansas"],
                ],
                "america/los_angeles" => [
                    ["iso_code" => "CA", "description" => "California"],
                    ["iso_code" => "NV", "description" => "Nevada"],
                    ["iso_code" => "OR", "description" => "Oregon"],
                    ["iso_code" => "WA", "description" => "Washington"],
                ],
                "pacific/honolulu" => [
                    ["iso_code" => "HI", "description" => "Hawaii"],
                ],
            ],
            "VE" => [
                "america/caracas" => "*"
            ],
            "CO" => [
                "america/bogota" => "*"
            ],
            "MX" => [
                "america/mexico_city" => "*"
            ],
            "UY" => [
                "america/montevideo" => "*"
            ],
            "PE" => [
                "america/lima" => "*"
            ],
            "GT" => [
                "america/guatemala" => "*"
            ],
            "CR" => [
                "america/costa_rica" => "*"
            ],
            "NI" => [
                "america/managua" => "*"
            ],
            "PA" => [
                "america/panama" => "*"
            ],
            "HN" => [
                "america/tegucigalpa" => "*"
            ],
            "EC" => [
                "america/guayaquil" => "*"
            ],
            "SV" => [
                "america/el_salvador" => "*"
            ],
        ];

        //Trabajar solo con los paises donde hay presencia YEZZ
        $countries = Country::whereIn('iso_code', trans('globals.countries_yezz'))->orderBy('description')->get();
        foreach ($countries as $country) {
            //Solo buscar los estados y ciudades de estos paises, para precargar las zonas horarias
            foreach ($timezones[$country['iso_code']] as $time_zone => $provinces) {
                
                //Si es un array, actualizo los valores de cada estado y cambio las zonas horarias de las ciudades de estos estados
                if (is_array($provinces)) {
                    foreach ($provinces as $item) {
                        //Actualizacion del iso_code de la provincia
                        $province = Province::where('country_id', $country->id)->where('description', $item['description'])->first();
                        $province->update(['iso_code' => $item['iso_code']]);

                        //Actualizacion de zona horaria de las ciudades de esta provincia
                        $cities = City::where('province_id', $province->id)->get();
                        foreach ($cities as $city) {
                            $city->update(['timezone' => $time_zone]);
                        }
                    }
                } else {
                    //Se actualizan todas las ciudades de todos los estados de un pais con una misma zona horaria
                    $provinces = Province::select('id')->where('country_id', $country->id)->get();
                    $cities = City::whereIn('province_id', $provinces)->get();
                    foreach ($cities as $city) {
                        $city->update(['timezone' => $time_zone]);
                    }
                }
            }
            
        }

        /*$countries = Country::all();

        $countries->each(function ($item) use ($provinces) {
        
            //Actualizacion de datos de estados, con zonas horarias

            //Viejo proceso de carga
            foreach ($provinces as $province) {
                if ($item->iso_code == $province['country_code']) {
                    
                    $new_province = Province::create([
                        'country_id' => $item->id,
                        'description' => $province['description'],
                    ]);

                    foreach ($province['cities'] as $cities) {
                        if (is_array($cities)) {
                            
                            //$this->command->info($cities['description']);
                            City::create([
                                'province_id' => $new_province->id,
                                'description' => $cities['description'],
                                'timezone' => $cities['timezone']
                            ]);
                        }
                    }
                }
            }
           
        });*/

    }
}
