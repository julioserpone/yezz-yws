<?php

/**
 * Akkar Global Services - Routes Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\Country;
use App\Route;
use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = Country::all();

        foreach ($countries as $country) {
            Route::create([
                'description' => 'YEZZ-'.$country->iso_code
            ]);
        }
    }
}
