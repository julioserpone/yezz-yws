<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderFailure extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_failures';
    public $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'order_id',
    	'failure_id',
    	'date_registered',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function failure()
    {
        return $this->belongsTo(Failure::class);
    }
}
