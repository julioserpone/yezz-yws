<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';
    public $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'country_id',
    	'province_id',
    	'city_id',
    	'cellphone_number',
    	'homephone_number',
    	'email',
    	'shipping_address',
    	'zip_code',
    	'status',
        'type'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function person()
    {
        return $this->hasOne(Person::class);
    }

    public function business()
    {
        return $this->hasOne(Business::class);
    }

    public function scopeListAll($query, $q='')
    {
        //Person 
        $persons = self::select('clients.id as id', \DB::raw('CONCAT(persons.last_name, ", ", persons.first_name) AS names'))
                        ->join('persons', 'clients.id', '=', 'persons.client_id');

        //Business union Persons
        $business = self::select('clients.id as id', 'businesses.description as names')
                        ->join('businesses', 'clients.id', '=', 'businesses.client_id');

        if ($q != '') {
            $persons->whereRaw("first_name like '%" . $q . "%' or last_name like '%" . $q . "%'");
            $business->whereRaw("description like '%" . $q . "%'");
        }

        return $business->union($persons)->orderBy('names', 'asc');
    }

    /**
     * Verifica que no exista otro cliente con un mismo atributo. La busqueda se realiza en funcion del tipo de cliente
     * @param  QueryBuilder $query Query Eloquent
     * @param  string $field atributo a consultar
     * @param  string $value Valor del atributo
     * @return Boolean       True o false
     */
    public function otherCustomersWithSameAttributes($request)
    {
        switch ($this->type)
        {
            case 'person':
                $found = (
                    Person::where('id', '!=', $this->person->id)
                        ->where(function ($query) use ($request) {
                            $query->where('identification', $request->get('identification'))
                            ->where('first_name', $request->get('first_name'))
                            ->where('last_name', $request->get('last_name'));
                        })->first()
                ) ? true : false;
                break;
            case 'business':
                $found = (
                    Business::where('id', '!=', $this->business->id)
                        ->where(function ($query) use ($request) {
                            $query->where('code_identification', $request->get('code_identification'))
                            ->where('description', $request->get('description'));
                        })->first()
                ) ? true : false;
                break;

        }
        return $found;
    }

    public function getFullShippingAddressAttribute() {
        $shipping_adress = strtoupper($this->shipping_address);
        $shipping_adress .= strtoupper(($this->zip_code) ? ", CP $this->zip_code" : "");
        $city = $this->city->description;
        $province = $this->province->description;
        $country = $this->country->description;
        $shipping_adress .= strtoupper(", $city, $province, $country.");
        return $shipping_adress;
    }

    public function getFullNameAttribute() {

        return strtoupper(($this->type == 'person') ? $this->person->first_name.' '.$this->person->last_name : $this->business->description);
        
    }
}
