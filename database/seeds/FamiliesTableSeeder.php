<?php

/**
 * Akkar Global Services - Families Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\Family;
use Illuminate\Database\Seeder;

class FamiliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $families = array('','BERRY','BINGO','DOMO','LOTTO','PANA','TEK','TEKQ','ANDY','BILLY','BONIT','BONO','CHIC','CHIC2','CLAS','CLAS2','CLAS2','EXCLUS','FASH','MODA','MONACO','RITM','RITM2','RITM3','Z1','ZENIOR');

        foreach ($families as $family) {
            Family::create([
                'description' => $family
            ]);
        }
    }
}
