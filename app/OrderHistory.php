<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class OrderHistory extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_histories';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $appends = ['TimeElapsed'];
    protected $dates = ['log_date','deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'order_id',
    	'state_id',
    	'user_id',
        'deleted_by',
    	'log_date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class)->withTrashed();
    }

	public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by')->withTrashed();
    }

    public function comments()
    {
        return $this->hasMany(OrderHistoryComment::class);
    }

    public function actions()
    {
        return $this->hasMany(OrderHistoryAction::class)->withTrashed()->orderBy('log_date', 'desc');
    }

    public function diagnostics()
    {
        return $this->hasMany(OrderHistoryDiagnostic::class)->withTrashed()->orderBy('log_date', 'desc');
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
