<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workshop extends Model
{
 	use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workshops';
    public $primaryKey = 'id';
    public $timestamps = true;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'country_id',
    	'route_id',
        'identification',
    	'description',
        'contact_name',
        'officephone_number',
        'email',
        'work_schedule',
        'type',
        'address',
        'comment',
    	'status'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

        public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
