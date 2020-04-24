<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrdersTableSeeder extends Seeder
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
            DB::table('orders')->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM orders');
        } else {
            DB::statement('TRUNCATE TABLE orders CASCADE');
        }

        $orders = [
            [
                'number'        => Str::random(10),
                'user_id'       => 1,
                'shipment_id'   => 1,
            ],
            [
                'number'        => Str::random(10),
                'user_id'       => 1,
                'shipment_id'   => 2,
            ],
            [
                'number'        => Str::random(10),
                'user_id'       => 2,
                'shipment_id'   => 3,
            ],
            [
                'number'        => Str::random(10),
                'user_id'       => 3,
                'shipment_id'   => 4,
            ],
        ];

        DB::table('orders')->insert($orders);

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
