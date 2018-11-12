<?php

/**
 * Akkar Global Services - Products Type Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\ProductType;
use Illuminate\Database\Seeder;

class ProductsTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products_type = array('SMARTPHONE','TABLET','FEATUREPHONE','MANUFACTORE PHONE');

        foreach ($products_type as $type) {
            ProductType::create([
                'description' => $type
            ]);
        }
    }
}
