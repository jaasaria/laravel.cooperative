<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	$faker = Faker\Factory::create();

        DB::table('tr_settings')->insert([
            'field' => 'Website Name',
            'value' => 'Iloilo Finest Business Software and Innovation',
            'description' => 'Name of Website',
        ]);
        DB::table('tr_settings')->insert([
            'field' => 'Initial Name',
            'value' => 'IloFinest',
            'description' => 'Website Initial Name',
        ]);
        DB::table('tr_settings')->insert([
            'field' => 'Description',
            'value' => 'Welcome to IloFinest Cooperative. The Online Inventory Tracking System',
            'description' => 'Website Short Description',
        ]);


        DB::table('tr_settings')->insert([
            'field' => 'Telephone Number',
            'value' => '033-0000',
            'description' => 'Contact or Mobile Number',
        ]);
        DB::table('tr_settings')->insert([
            'field' => 'Contact Person',
            'value' => 'John Andrew Asaria',
            'description' => 'Contact Person or Administrator Name',
        ]);
        DB::table('tr_settings')->insert([
            'field' => 'Copyright',
            'value' => '2016-2017',
            'description' => 'Year From - To',
        ]);

    }
}
