<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class OrderHistoryAction extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_history_actions';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = ['log_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
    	'order_history_id',
    	'action_id',
    	'user_id',
        'deleted_by',
    	'comment',
    	'log_date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function order_history()
    {
        return $this->belongsTo(OrderHistory::class)->withTrashed();
    }

    public function action()
    {
        return $this->belongsTo(Action::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by')->withTrashed();
    }

    public function getTimeElapsedAttribute()
    {
        $now = $this->order->DateForTimezone;   //Now date
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['log_date']);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $now->toDateTimeString());
        
        Carbon::setLocale(\Auth::user()->language);
        return $to->diffForHumans($from);
    }
}
