<?php

/**
 * Akkar Global Services - Users Seeder
 *
 * @author Julio Hernandez <juliohernandezs@gmail.com>
 *
 * @date(Nov 23 - 2016)
 */

use App\User;
use App\Country;
use App\Workshop;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        //Administrator
        User::create([
            'country_id' => Country::select(['id'])->where('iso_code','VE')->first()->id,
            'role' => 'admin',
            'first_name' => 'Julio',
            'last_name' => 'Hernandez',
            'username' => 'admin',
            'gender' => 'male',
            'pic_url' => '/profile_img/avatar.png',
            'identification' => $faker->unique()->numberBetween(1, 99999),
            'birth_date' => $faker->dateTimeBetween('-40 years', '-16 years'),
            'cellphone_number' => '+584241234567',
            'email' => 'jhernandez@yezzcorp.com',
            'password' => \Hash::make('16050222'),
        ]);

        //User type PostSales  for demo
        User::create([
            'country_id' => Country::select(['id'])->where('iso_code','VE')->first()->id,
            'role' => 'admin',
            'first_name' => 'MARY',
            'last_name' => 'OCHOA',
            'username' => 'mochoa',
            'gender' => 'female',
            'pic_url' => '/profile_img/avatar.png',
            'identification' => $faker->unique()->numberBetween(1, 99999),
            'birth_date' => $faker->dateTimeBetween('-40 years', '-16 years'),
            'cellphone_number' => '+584241234567',
            'email' => 'mochoa@yezzcorp.com',
            'password' => \Hash::make('123456'),
        ]);

        User::create([
            'country_id' => Country::select(['id'])->where('iso_code','VE')->first()->id,
            'role' => 'manager',
            'first_name' => 'CARLOS',
            'last_name' => 'MUÑOZ',
            'username' => 'cmunoz',
            'gender' => 'male',
            'pic_url' => '/profile_img/avatar.png',
            'identification' => $faker->unique()->numberBetween(1, 99999),
            'birth_date' => $faker->dateTimeBetween('-40 years', '-16 years'),
            'cellphone_number' => '+584241234567',
            'email' => 'cmunoz@yezzcorp.com',
            'password' => \Hash::make('123456'),
        ]);

        User::create([
            'country_id' => Country::select(['id'])->where('iso_code','VE')->first()->id,
            'role' => 'analist',
            'first_name' => 'ALEJANDRA',
            'last_name' => 'MUJICA',
            'username' => 'amujica',
            'gender' => 'female',
            'pic_url' => '/profile_img/avatar.png',
            'identification' => $faker->unique()->numberBetween(1, 99999),
            'birth_date' => $faker->dateTimeBetween('-40 years', '-16 years'),
            'cellphone_number' => '+584241234567',
            'email' => 'amujica@yezzcorp.com',
            'password' => \Hash::make('123456'),
        ]);

        User::create([
            'country_id' => Country::select(['id'])->where('iso_code','VE')->first()->id,
            'role' => 'analist',
            'first_name' => 'SILBERTH',
            'last_name' => 'MORENO',
            'username' => 'smoreno',
            'gender' => 'male',
            'pic_url' => '/profile_img/avatar.png',
            'identification' => $faker->unique()->numberBetween(1, 99999),
            'birth_date' => $faker->dateTimeBetween('-40 years', '-16 years'),
            'cellphone_number' => '+584241234567',
            'email' => 'smoreno@yezzcorp.com',
            'password' => \Hash::make('123456'),
        ]);

        //Call Center, Analists, Workshops, Client and Manager
        for ($i = 0; $i < 25; $i++) {
            $first_name = $faker->unique()->firstName;
            $last_name = $faker->unique()->lastName;
            $role = $faker->randomElement(array_keys(trans('globals.roles')));
            $country_id = Country::select(['id'])->orderByRaw('RAND()')->first()->id;
            $workshop = null;
            if ($role == 'workshop') {
                $workshop = Workshop::select(['id'])->where('country_id', $country_id)->orderByRaw('RAND()')->first();
            }
            User::create([
                'country_id' => $country_id, 
                'workshop_id' => ($workshop) ? $workshop->id : null,
                'role' => $role,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'username' => substr($first_name, 1, 1).strtolower($last_name),
                'gender' => $faker->randomElement(array_keys(trans('globals.gender'))),
                'pic_url' => '/profile_img/avatar' . $faker->numberBetween(1, 6) . '.png',
                'identification' => $faker->unique()->numberBetween(1, 99999),
                'birth_date' => $faker->dateTimeBetween('-40 years', '-16 years'),
                'cellphone_number' => $faker->phoneNumber,
                'homephone_number' => $faker->phoneNumber,
                'email' => $faker->unique()->email,
                'password' => \Hash::make('123456'),
            ]);
        }
    }
}
