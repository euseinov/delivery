<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['number', 'user_id', 'shipment_id'];

    /**
     * Get the User record associated with the Order.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the Shipment record associated with the Order.
     */
    public function shipment()
    {
        return $this->belongsTo('App\Shipment', 'shipment_id');
    }
}
