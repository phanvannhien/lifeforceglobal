<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
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
        DB::table('product')->delete();

    	for ($i = 0; $i < 100; $i++) {
            DB::table('product')->insert([ //,
                'category_id' => $faker->numberBetween($min = 1, $max = 6),
                'product_name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'product_sort_description' => $faker->sentence($nbWords = 12, $variableNbWords = true),
                'product_description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'price_RPP' =>  $faker->numberBetween($min = 100, $max = 1000),
                'price_discount' =>  $faker->numberBetween($min = 50, $max = 500),
                'product_thumbnail' =>  $faker->imageUrl(285, 380, 'cats'),
                'product_images' => $faker->imageUrl(600, 600, 'cats'),
            ]);
        }
    }
}
