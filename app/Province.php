<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
	use SoftDeletes;
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'provinces';
    public $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id','description','iso_code','status'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
