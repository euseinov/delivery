<?php

use App\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
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
            DB::table('tasks')->truncate();
        } elseif (DB::connection()->getDriverName() == 'sqlite') {
            DB::statement('DELETE FROM tasks');
        } else {
            DB::statement('TRUNCATE TABLE tasks CASCADE');
        }

        $tasks = [
            [
                'name'          => 'Get parcel',
                'type'          => Task::TASK_TYPE_RECEIVE,
                'user_id'       => 1,
                'location_id'   => 1,
            ],
            [
                'name'          => 'Deliver parcel',
                'type'          => Task::TASK_TYPE_SHIPPING,
                'user_id'       => 1,
                'location_id'   => 2,
            ],
            [
                'name'          => 'Get parcel',
                'type'          => Task::TASK_TYPE_RECEIVE,
                'user_id'       => 1,
                'location_id'   => 3,
            ],
            [
                'name'          => 'Deliver parcel',
                'type'          => Task::TASK_TYPE_SHIPPING,
                'user_id'       => 1,
                'location_id'   => 4,
            ],
            [
                'name'          => 'Get parcel',
                'type'          => Task::TASK_TYPE_RECEIVE,
                'user_id'       => 2,
                'location_id'   => 5,
            ],
            [
                'name'          => 'Deliver parcel',
                'type'          => Task::TASK_TYPE_SHIPPING,
                'user_id'       => 2,
                'location_id'   => 6,
            ],
            [
                'name'          => 'Get parcel',
                'type'          => Task::TASK_TYPE_RECEIVE,
                'user_id'       => 3,
                'location_id'   => 7,
            ],
            [
                'name'          => 'Deliver parcel',
                'type'          => Task::TASK_TYPE_SHIPPING,
                'user_id'       => 3,
                'location_id'   => 8,
            ],
        ];

        DB::table('tasks')->insert($tasks);

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
