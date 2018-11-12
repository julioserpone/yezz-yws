<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistoryComment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_history_comments';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = ['log_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id',
    	'order_history_id',
    	'comment',
    	'log_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function order_history()
    {
        return $this->belongsTo(OrderHistory::class)->withTrashed();
    }
}
