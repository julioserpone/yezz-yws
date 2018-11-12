<?php

/**
 * Akkar Global Services - Users Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\Client;
use App\Person;
use App\Business;
use App\Country;
use App\Province;
use App\City;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $country = Country::where('iso_code','VE')->first();

        for ($i = 0; $i < 30; $i++) {

            //Province and City
            $province = Province::where('country_id',$country->id)
                ->where('description','CARABOBO')
                ->whereOr('description','DISTRITO CAPITAL')
                ->orderByRaw('RAND()')->first();
            $city = City::where('province_id',$province->id)->orderByRaw('RAND()')->first();

            $type_client = $faker->randomElement(array_keys(trans('globals.type_client')));

            switch ($type_client) {
                case 'person':
                    Person::create([
                        'first_name' => $faker->unique()->firstName,
                        'last_name' => $faker->unique()->lastName,
                        'identification' => $faker->unique()->numberBetween(1, 999999999),
                        'client' => [
                            'country_id' => $country->id,
                            'province_id' => $province->id,
                            'city_id' => $city->id,
                            'cellphone_number' => $faker->phoneNumber,
                            'homephone_number' => $faker->phoneNumber,
                            'email' => $faker->unique()->email,
                            'shipping_address' => $faker->streetAddress,
                            'zip_code' => $faker->postcode,
                            'type' => $type_client,
                        ],
                    ]);
                    break;

                case 'business':
                    Business::create([
                        'description' => $faker->unique()->catchPhrase,
                        'code_identification' => $faker->unique()->numberBetween(1, 999999999),
                        'contact_name' => $faker->unique()->firstName." ".$faker->unique()->lastName,
                        'client' => [
                            'country_id' => $country->id,
                            'province_id' => $province->id,
                            'city_id' => $city->id,
                            'cellphone_number' => $faker->phoneNumber,
                            'homephone_number' => $faker->phoneNumber,
                            'email' => $faker->unique()->companyEmail,
                            'shipping_address' => $faker->streetAddress,
                            'zip_code' => $faker->postcode,
                            'type' => $type_client,
                        ],
                    ]);
                    break;                
            }

        } //for
    }
}
