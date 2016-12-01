<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
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

 		$limit = 100;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('tbl_supplier')->insert([
	            'name' => $faker->name,
	            'address' =>  $faker->word,
	            'active' =>  1,
	            'telNO' =>  $faker->ean13,
	            'mobileNO' =>  $faker->ean13,
	            'faxno' =>  $faker->ean13,
	            'website' =>  $faker->ean13,
	            'email' =>  $faker->ean13,
	            'notes' =>  $faker->word,
	        ]);
        }





    }
}
