<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const TASK_TYPE_RECEIVE = 1;
    const TASK_TYPE_SHIPPING = 2;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_complete', 'location_id', 'type'
    ];

    /**
     * Get the User record associated with the Task.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the Location record associated with the Task.
     */
    public function locations()
    {
        return $this->hasMany('App\Location', 'location_id');
    }
}
