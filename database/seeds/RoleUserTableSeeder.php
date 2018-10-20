<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 5; $i++) {
        	\DB::table('role_user')->insert([
        		'role_id' => ($i == 1) ? 2 : 1,
        		'user_id' => $i,
        	]);
        }
    }
}
