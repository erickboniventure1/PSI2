<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);

        $faker = Faker\Factory::create();

        $regions = [
        	'Arusha', 'Mwanza', 'Dar es Salaam', 'Dodoma',
        	'Morogoro',
        ];

        for($i = 0; $i < 5; $i++) {

            $last_name = $faker->lastName();

        	$user = App\User::create([
		        'first_name' => $faker->firstName(),
		        'last_name' => $last_name,
		        'phone_number' => $faker->phoneNumber(),
                'email' => ($i == 0) ? 'admin@psi.com' : $faker->email(),
                'password' => bcrypt(strtoupper($last_name)),
		        'device_sn' => $faker->randomNumber(),
		        'device_imei' => $faker->randomNumber(),
		        'status' => true,
		        'description' => $faker->paragraph(3, true),
           ]);

        	$region = App\Region::create([
		        'name' => $regions[$i],
            ]);

        	for($d = 0; $d < 3; $d++) {
        		$district = App\District::create([
	            	'region_id' => $region->id,
			        'name' => $faker->city(),
	            ]);

	            for ($f=0; $f < 6; $f++) { 
	            	$facility = App\Facility::create([
	        			'user_id' => $user->id,
				    	'district_id' => $district->id,
				    	'region_id' => $region->id,
				    	'name' => $faker->company(),
				    	'description' => $faker->paragraph(3, true),
				    	'status' => true,
        			]);

        			$facility->staff()->create([
        				'first_name' => $faker->firstName(),
				        'last_name' => $faker->lastName(),
				        'phone_number' => $faker->phoneNumber(),
				        'device_sn' => $faker->randomNumber(),
				        'device_imei' => $faker->randomNumber(),
				        'type' => ($f%2 == 0) ? 'ipc' : 'provider',
				        'status' => true,
				        'description' => $faker->paragraph(3, true),
        			]);
	            }
        	}

            
        }

         $this->call(RoleUserTableSeeder::class);

    }
}
