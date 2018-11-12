<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
 	use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';
    public $primaryKey = 'id';
    public $timestamps = true;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'producttype_id',
    	'brand_id',
    	'family_id',
    	'technology_id',
    	'scale_id',
        'color_id',
    	'code',
    	'model',
        'part_number',
        'description',
    	'state',
    ];

    public function producttype()
    {
        return $this->belongsTo('App\ProductType');
    }

	public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function family()
    {
        return $this->belongsTo('App\Family');
    }

    public function technology()
    {
        return $this->belongsTo('App\Technology');
    }

    public function scale()
    {
        return $this->belongsTo('App\Scale');
    }

    public function color()
    {
        return $this->belongsTo('App\Color');
    } 
}
