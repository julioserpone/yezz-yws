<?php

/**
 * Akkar Global Services - Users Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\Workshop;
use App\Country;
use App\Route;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class WorkshopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        for ($i = 0; $i < 15; $i++) {
            $country = Country::select(['id','iso_code'])->orderByRaw('RAND()')->first();
            $route = Route::where('description', 'like', '%' . $country->iso_code)->select(['id'])->first();
            Workshop::create([
                'country_id' => $country->id,
                'route_id' => $route->id,
                'identification' => $faker->unique()->numberBetween(1, 999999999),
                'description' => $faker->unique()->company,
                'contact_name' => $faker->unique()->firstName.' '.$faker->unique()->lastName,
                'officephone_number' => $faker->phoneNumber,
                'email' => $faker->unique()->email,
                'address' => $faker->streetAddress,
                'comment' => $faker->text,
            ]);

        }
    }
}
