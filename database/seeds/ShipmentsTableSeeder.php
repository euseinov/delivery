<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipmentsTableSeeder extends Seeder
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
            DB::table('shipments')->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM shipments');
        } else {
            DB::statement('TRUNCATE TABLE shipments CASCADE');
        }

        $shipments = [
            [
                'from_location_id'  => 1,
                'to_location_id'    => 2,
                'name'              => 'parcel 1',
                'cost'              => rand(1, 100),
            ],
            [
                'from_location_id'  => 3,
                'to_location_id'    => 4,
                'name'              => 'parcel 2',
                'cost'              => rand(1, 100),
            ],
            [
                'from_location_id'  => 5,
                'to_location_id'    => 6,
                'name'              => 'parcel 3',
                'cost'              => rand(1, 100),
            ],
            [
                'from_location_id'  => 7,
                'to_location_id'    => 8,
                'name'              => 'parcel 4',
                'cost'              => rand(1, 100),
            ],
        ];

        DB::table('shipments')->insert($shipments);

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

    }
}
