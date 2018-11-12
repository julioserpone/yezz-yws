<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Failure extends Model
{
	use SoftDeletes;
    use \Dimsav\Translatable\Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'failures';
    public $primaryKey = 'id';
    public $timestamps = true;

    public $translatedAttributes = ['name'];
    protected $fillable = ['code', 'name', 'status'];

    public function translations()
    {
        return $this->hasMany(FailureTranslation::class);
    }
}

//Used for Translations
class FailureTranslation extends Model {

    public $timestamps = false;
    protected $fillable = ['name'];

    public function failure()
    {
        return $this->belongsTo(Failure::class)->withTrashed();
    }
}