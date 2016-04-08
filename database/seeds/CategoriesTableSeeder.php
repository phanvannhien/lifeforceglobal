<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        $faker = Faker\Factory::create();
        DB::table('categories')->truncate();
        
        $arrayDataCate = array(
        	array(
        		'category_name' => 'Products', 
        		'parent_id' => 0,
        		'category_description' => '',
        	),
            /*
        	array(
        		'category_name' => 'Home Application', 
        		'parent_id' => 0,
        		'category_description' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        	),
        	array(
        		'category_name' => 'Mom & Baby', 
        		'parent_id' => 0,
        		'category_description' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        	),
        	array(
        		'category_name' => 'Fashion', 
        		'parent_id' => 0,
        		'category_description' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        	),
        	array(
        		'category_name' => 'Gaming', 
        		'parent_id' => 0,
        		'category_description' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        	),
        	array(
        		'category_name' => 'Sport', 
        		'parent_id' => 0,
        		'category_description' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        	)
            */
        );
    	
        DB::table('categories')->insert( $arrayDataCate );
        
            
    }
}
