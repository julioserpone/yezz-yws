<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    public $primaryKey = 'id';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'first_name',
        'last_name',
        'identification'
    ];
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

        public function fullName()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public static function create(array $attr = []) {
        if (!isset($attr['client_id']) && isset($attr['client'])) {
            $client = Client::create($attr['client']);
            $attr['client_id'] = $client->id;
            unset($attr['client']);
        }
        //version laravel 5.3
        //return parent::create($attr);

        //Version laravel 5.4
        $model = static::query()->create($attr);
        return $model;
    }
}
