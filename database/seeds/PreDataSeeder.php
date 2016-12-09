<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PreDataSeeder extends Seeder
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

         DB::table('users')->insert([
            'name' => 'John Andrew',
            'middlename' => 'Jayme',
            'lastname' =>  'Asaria',
            'email' => 'asaria.ja@gmail.com',
            'address' => 'Iloilo City, Philippines',
            'notes' => 'Author / Owner',
            'password' =>  '$2y$10$ZgBXd5JPNlse6tiA/o0Z7OiMxTEk62uy7T9H8lAfM8dIv7MiG7.hi',

            'verified' =>  '1',
            'active' =>  '1',
            'created_at' => Carbon::now(),
        ]);

        DB::table('tbl_role')->insert([
            'name' => 'Administrator',
            'description' => 'Administrator',
            'created_at' => Carbon::now(),
        ]);
        DB::table('tbl_role')->insert([
            'name' => 'User',
            'description' => 'User',
            'created_at' => Carbon::now(),
        ]);



        DB::table('tbl_permission')->insert([
            'name' => 'User List',
            'value' => 'c,r,u,d',
            'description' => 'User List
c = create , r = read ,  u = update , d = delete',
            'created_at' => Carbon::now(),
        ]);

        DB::table('tbl_permission')->insert([
            'name' => 'Role / Permission',
            'value' => 'c,r,u,d,p',
            'description' => 'User List
c = create , r = read ,  u = update , d = delete , p = permission',
            'created_at' => Carbon::now(),
        ]);




    }
}
