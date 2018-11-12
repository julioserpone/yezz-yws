<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
	use SoftDeletes;
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';
    public $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['province_id','description','timezone','status'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
