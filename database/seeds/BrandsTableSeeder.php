<?php

/**
 * Akkar Global Services - Brands Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = array('YEZZ','NIU','BLAC','BLACKBERRY','APPL','NOKIA','PARLA','SAMSUNG');

        foreach ($brands as $brand) {
            Brand::create([
                'description' => $brand
            ]);
        }
    }
}
