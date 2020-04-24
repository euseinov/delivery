<?php

namespace App\Http\Controllers;

use App\Shipment;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Json;

/**
 * Class TaskController.
 * @desc Task Api end point CRUD operation
 */
class TaskController extends Controller
{
    /**
    * Update data for a particular resource of Task
    *
    * @param $request Request
    * @param $taskId int
    *
    * @return json
    */
    public function update(Request $request, $taskId)
    {
        $input = $request->all();
        $validator = $this->updateValidator($input);

        if ($validator->fails()) {
            return Response::json([
                'message'       =>  'Could not update task',
                'errors'        =>  $validator->errors(),
                'status_code'   =>  400
            ], 400);
        }

        $task = Task::where('id', $taskId)->where('user_id', $input['user_id'])->first();

        if (!$task) {
            return Response::json([
                'message'       =>  'Could not update task',
                'errors'        =>  'Task not found',
                'status_code'   =>  400
            ], 400);
        }

        if ($task->is_complete) {
            return Response::json([
                'message'       =>  'Could not update task',
                'errors'        =>  'Task already complete',
                'status_code'   =>  422
            ], 422);
        }

    	$locationId = $task->location_id;

    	if ($task->type == Task::TASK_TYPE_RECEIVE) {
            Shipment::where('from_location_id', $locationId)->update(['is_received' => 1]);
        } else if ($task->type == Task::TASK_TYPE_SHIPPING) {
            $shipment = Shipment::where('to_location_id', $locationId)->where('is_received', 1)->first();

            if (!$shipment) {
                return Response::json([
                    'message'       =>  'Could not update task',
                    'errors'        =>  'Shipping is not received yet',
                    'status_code'   =>  422
                ], 422);
            }

            if ($shipment->is_shipped) {
                return Response::json([
                    'message'       =>  'Could not update task',
                    'errors'        =>  'Shipping already delivered',
                    'status_code'   =>  422
                ], 422);
            }

            $shipment->update(['is_shipped' => 1]);
            User::find($task->user_id)->increment('balance', $shipment->cost);
        }
        $task->update(['is_complete' => 1]);

        return response()->json($task, 200);
    }

    /**
     *
     * @param type $data
     * @return type
     */
    private function updateValidator($data)
    {
        return Validator::make($data, [
            'user_id'  => 'required',
        ]);
    }
}
