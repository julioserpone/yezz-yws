<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{

    protected $table = 'businesses';
    public $primaryKey = 'id';
	public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'description',
        'contact_name',
        'code_identification',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
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
