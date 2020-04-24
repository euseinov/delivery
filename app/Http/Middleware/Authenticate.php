<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        echo Response::json([
            'message'       =>  'Invalid token',
            'errors'        =>  'Operation is not allowed',
            'status_code'   =>  403
        ], 403);
        exit;
    }
}
