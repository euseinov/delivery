<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Json;

/**
 * Class TransactionsController.
 * @desc Transactions Api end point CRUD operation
 */
class TransactionsController extends Controller
{
    /**
     * Store data for a particular resource of Transactions
     *
     * @param $request Request
     *
     * @return json
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = $this->createValidator($input);

        if ($validator->fails()) {
            return Response::json([
                'message'       =>  'Could not create transaction',
                'errors'        =>  $validator->errors(),
                'status_code'   =>  400
            ], 400);
        }

        $userFrom = User::find($input['from_user_id']);
        $userTo = User::find($input['to_user_id']);

        if (!$userFrom) {
            return Response::json([
                'message'       =>  'Could not create transaction',
                'errors'        =>  'Money sender User not found',
                'status_code'   =>  422
            ], 422);
        }
        if (!$userTo) {
            return Response::json([
                'message'       =>  'Could not create transaction',
                'errors'        =>  'Money receiver User not found',
                'status_code'   =>  422
            ], 422);
        }

        if ($userFrom->balance < $input['amount']) {
            return Response::json([
                'message'       =>  'Could not create transaction',
                'errors'        =>  'Operation is not allowed',
                'status_code'   =>  422
            ], 422);
        }

        $userFromBalanceAfter = $userFrom->balance - $input['amount'];
        $userToBalanceAfter = $userTo->balance + $input['amount'];
        $info = "User {$userFrom->name} (id: {$userFrom->id}) balance was - {$userFrom->balance}" . PHP_EOL;
        $info .= "User {$userTo->name} (id: {$userTo->id}) balance was - {$userTo->balance}" . PHP_EOL;
        $info .= "Transaction, User: {$userFrom->name} (id: {$userFrom->id}) to User {$userTo->name} (id: {$userTo->id}) has sent $ {$input['amount']}. Current balance is - {$userFromBalanceAfter}" . PHP_EOL;
        $info .= "Transaction, User: {$userTo->name} (id: {$userTo->id}) to User {$userFrom->name} (id: {$userFrom->id}) has received $ {$input['amount']}. Current balance is - {$userToBalanceAfter}" . PHP_EOL;
        $info .= "User {$userFrom->name} (id: {$userFrom->id}) balance is - {$userFromBalanceAfter}" . PHP_EOL;
        $info .= "User {$userTo->name} (id: {$userTo->id}) balance is - {$userToBalanceAfter}";

        $input['created_at'] = Carbon::now();
        $input['info'] = $info;
        $userFrom->increment('balance', -$input['amount']);
        $userTo->increment('balance', $input['amount']);
        $transaction = Transaction::create($input);

        return response()->json($transaction, 201);
    }

    /**
     *
     * @param type $data
     * @return type
     */
    private function createValidator($data)
    {
        return Validator::make($data, [
            'from_user_id'  => 'required',
            'to_user_id'    => 'required',
            'amount'        => 'required',
        ]);
    }
}
