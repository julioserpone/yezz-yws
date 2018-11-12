<?php

/**
 * Akkar Global Services - Chains Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\Country;
use App\Chain;
use Illuminate\Database\Seeder;

class ChainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chains = array('YEZZ','NIU');

        //Venezuela
        $country = Country::where('iso_code','VE')->first();

        foreach ($chains as $chain) {
            Chain::create([
                'country_id' => $country->id,
                'description' => $chain
            ]);
        }
    }
}
