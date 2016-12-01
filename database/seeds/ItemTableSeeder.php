<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();






        $limit = 4000;

        for ($i = 0; $i < $limit; $i++) {
            
            DB::table('tbl_item')->insert([
	            'code' => $faker->ean13,
	            'name' => $faker->name,
	            'cost' =>  $faker->randomFloat(2,1,100),
	            'price' => $faker->randomFloat(2,1,100),
	            'active' =>  1,
	            'tax' =>  12,
	            'qty' =>  1,
	            'description' => $faker->word,
	        ]);
        }




    }
}
