<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'order_id'];

    /**
     * Get the Location record associated with the Order.
     */
    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }

    /**
     * Get the Location record associated with the Task.
     */
    public function task()
    {
        return $this->belongsTo('App\Task', 'task_id');
    }
}
