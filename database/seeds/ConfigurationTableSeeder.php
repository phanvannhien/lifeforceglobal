<?php

use Illuminate\Database\Seeder;

class ConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('configuration')->truncate();
        DB::table('configuration')->insert(
        	array(
	        	array(
	        		'name' => 'bank',
	        		'value' => 'Bank info',
	        		'type' => 'textarea',
	        		'label' => 'Bank'
	        	),
	        	array(
	        		'name' => 'register_fee',
	        		'value' => '50',
	        		'type' => 'text',
	        		'label' => 'Register fee'
	        	)
	        )	
        );
    }
}
