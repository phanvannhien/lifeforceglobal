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
        
        DB::table('users')->insert([
            'name' => 'Admin',
            'name_suffix' => '_a',
            'email' => 'info@lifeforceglobal.com.au',
            'password' =>  Hash::make('123456'),
            'user_code' => '',
            'user_refferal' =>  '',
            'registration_date' => '',
            'user_status' =>  1,
            'admin' => 1,
            'register_fee' => ''
        ]);
        
    }
}
