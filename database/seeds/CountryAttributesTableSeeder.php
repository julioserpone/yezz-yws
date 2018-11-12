<?php

/**
 * Akkar Global system - Attributes Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 20 - 2016)
 */

use App\Country;
use App\CountryAttribute;
use App\Attribute;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CountryAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        $countries = Country::all();
        $attributes = Attribute::all();

        foreach ($countries as $country) {
            
            foreach ($attributes as $attribute) {

                switch ($attribute->code) {
                    case 'OS_SECUENCE':
                        $value = '1';
                        break;
                    
                    case 'TAX':
                        $value = $faker->numberBetween(1, 15);
                        break;

                    case 'CONVERSION_RATE':
                        $value = $faker->numberBetween(1, 15);
                        break;

                    case 'NIVEL_REPAIR_I':
                        $value = $faker->numberBetween(100, 350);
                        break;

                    case 'NIVEL_REPAIR_II':
                        $value = $faker->numberBetween(200, 450);
                        break;
                   
                }

                CountryAttribute::create([
                    'country_id'        => $country->id,
                    'attribute_id'      => $attribute->id,
                    'attribute_value'   => $value,
                ]);        
            }
        }
    }
}
