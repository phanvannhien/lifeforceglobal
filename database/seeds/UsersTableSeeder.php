<?php

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
        //
        $faker = Faker\Factory::create();
        DB::table('users')->truncate();

    	for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([ //,
                'name' => $faker->name,
                'name_suffix' => $faker->randomElement($array = array ('_a_w','_a')),
                'email' => $faker->unique()->email,
                'password' =>  Hash::make('123456'),
                'user_code' => $faker->md5 ,
                'user_refferal' =>  $faker->numberBetween($min = 1, $max = 50),
                'registration_date' => $faker->dateTimeThisMonth($max = 'now'),
                'user_status' =>  1,
                'register_fee' => 50,

            ]);
        }
        
    }
}
