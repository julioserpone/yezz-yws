<?php

/**
 * Akkar Global Services - Classes Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\Scale;
use Illuminate\Database\Seeder;

class ScalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scales = array('HIGH','MEDIUM','LOW');

        foreach ($scales as $scale) {
            Scale::create([
                'description' => $scale
            ]);
        }
    }
}
