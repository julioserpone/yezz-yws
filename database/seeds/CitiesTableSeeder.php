<?php

/**
 * Akkar Global Services - Cities Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(13/06/2016)
 */

use App\Country;
use App\Province;
use App\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = array(
            ['province' => 'CARABOBO', 'city' => array('SANTA ROSA','SAN DIEGO','SAN JOSE','GUACARA','LOS GUAYOS','VALENCIA')],
            ['province' => 'DISTRITO CAPITAL', 'city' => array('MIRANDA','CARACAS','EL HATILLO','BARUTA')]
        );

        //Recorremos cada item de provincias (estados), y agregamos solo las ciudades del array cities.
        $provinces = Province::with('country')->get();
        $provinces->each(function ($item) use ($cities) {
            //Si hay muchas provincias cargadas (de muchos paises), precargamos solo vzla (VE)
            if ($item->country->iso_code == 'VE') {
                foreach ($cities as $data) {
                    //
                    if ($item->description == $data['province']) {
                        foreach ($data['city'] as $city) {
                            City::create([
                                'province_id' => $item->id,
                                'description' => $city
                            ]);
                        }
                    }
                }
            }
        });
    }
}
