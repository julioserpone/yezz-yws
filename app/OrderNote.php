<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderNote extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_notes';
    public $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'order_id',
    	'user_id',
    	'comment',
    	'log_date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

	public function user()
    {
        return $this->belongsTo(User::class);
    }
}
