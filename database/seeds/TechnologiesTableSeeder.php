<?php

/**
 * Akkar Global Services - Technologies Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\Technology;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = array('', '2G','3G','4G','GSM');

        foreach ($technologies as $technology) {
            Technology::create([
                'description' => $technology
            ]);
        }
    }
}
