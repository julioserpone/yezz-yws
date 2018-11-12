<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'email_templates';
    public $primaryKey = 'id';
    public $timestamps = true;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'country_id',
    	'code',
        'img_header',
        'img_footer',
    	'body_message',
    	'text_external_link',
    	'img_ext_link',
    	'url_ext_link',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function scopeByCountry($query, $id)
    {
        return $query->where('country_id', $id);
    }
}
