<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'balance',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function generateToken()
    {
        $this->api_token = str_random(50);
        $this->save();

        return $this->api_token;
    }

    /**
     * Get the Order record associated with the User.
     */
    public function order()
    {
        return $this->hasMany('App\Order', 'order_id');
    }

    /**
     * Get the Task record associated with the User.
     */
    public function task()
    {
        return $this->hasMany('App\Task', 'task_id');
    }
}
