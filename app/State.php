<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use \Dimsav\Translatable\Translatable;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';
    public $primaryKey = 'id';
    public $timestamps = true;

    public $translatedAttributes = ['name'];
    protected $fillable = ['code', 'close_order', 'roles', 'name', 'status'];

    public function actions()
    {
        return $this->hasMany(ActionState::class);
    }

    public function diagnostics()
    {
        return $this->hasMany(DiagnosticState::class);
    }
}

//Used for Translations
class StateTranslation extends Model {

    public $timestamps = false;
    protected $fillable = ['name'];

}
