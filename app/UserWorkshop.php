<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWorkshop extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_workshop';
    public $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id',
    	'workshop_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function workshop()
    {
        return $this->belongsTo('App\Workshop');
    }
}
