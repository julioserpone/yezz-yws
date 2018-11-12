<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountryAttribute extends Model
{
	use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'country_attributes';
    protected $appends = ['country'];
    public $primaryKey = 'id';
    public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'attribute_id',
        'attribute_value',
    ];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function attribute()
    {
        return $this->belongsTo('App\Attribute');
    }

    public function getCountryAttribute() {
        return $this->hasOne('App\Country', 'id', 'country_id')->first();
    }

    public function correlative()
    {
        return \Utility::codeMasked($this->attribute_value, $this->country->iso_code);
    }

    public function scopeGetCountry($query, $country_id) 
    {
        return $query->where('country_id', $country_id);
    }

    public function scopeGetAttribute($query, $country_id, $attr)
    {
        $query->whereHas('attribute', function ($q) use ($attr) {
                    $q->where('code', 'like', '%'.$attr.'%');
                })
            ->where('country_id', $country_id);
    }

    public function scopeUpdateCorrelative()
    {
        $this->attribute_value+=1;
        $this->save();
    }

}
