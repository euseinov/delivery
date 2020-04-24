<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::table('locations')->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM locations');
        } else {
            DB::statement('TRUNCATE TABLE locations CASCADE');
        }

        $locations = [
            [
                'country'   => 'US',
                'city'      => 'Syracuse',
                'district'  => 'NY',
                'zip'       => '13202',
                'address'   => '852 Saint Marys Avenue',
            ],
            [
                'country'   => 'US',
                'city'      => 'Syracuse',
                'district'  => 'NY',
                'zip'       => '13224',
                'address'   => '473 Saint Marys Avenue',
            ],
            [
                'country'   => 'US',
                'city'      => 'Jacksonville',
                'district'  => 'FL',
                'zip'       => '32256',
                'address'   => '395 Cherry Tree Drive',
            ],
            [
                'country'   => 'US',
                'city'      => 'Florida',
                'district'  => 'FL',
                'zip'       => '32216',
                'address'   => '43 Boundary Street',
            ],
            [
                'country'   => 'US',
                'city'      => 'Minneapolis',
                'district'  => 'MN',
                'zip'       => '55410',
                'address'   => '114 Sycamore Fork Road',
            ],
            [
                'country'   => 'US',
                'city'      => 'Minneapolis',
                'district'  => 'MN',
                'zip'       => '55401',
                'address'   => '3875 Progress Way',
            ],
            [
                'country'   => 'US',
                'city'      => 'Shreveport',
                'district'  => 'LA',
                'zip'       => '71101',
                'address'   => '1701 Roguski Road',
            ],
            [
                'country'   => 'US',
                'city'      => 'Shreveport',
                'district'  => 'LA',
                'zip'       => '71101',
                'address'   => '3303 Emerson Road',
            ],
        ];

        DB::table('locations')->insert($locations);

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
