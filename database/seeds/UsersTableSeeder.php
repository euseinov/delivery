<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
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
            DB::table('users')->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM users');
        } else {
            DB::statement('TRUNCATE TABLE users CASCADE');
        }

        $users = [
            [
                'name'              => 'John Smith',
                'email'             => 'john@gmail.com',
                'password'          => bcrypt('123456'),
                'balance'           => 253.6,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'Mike Walt',
                'email'             => 'mike@gmail.com',
                'password'          => bcrypt('12345'),
                'balance'           => 120,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'Tom Jones',
                'email'             => 'tom@gmail.com',
                'password'          => bcrypt('1234'),
                'balance'           => 15.06,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        DB::table('users')->insert($users);

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
