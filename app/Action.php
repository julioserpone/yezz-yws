<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use \Dimsav\Translatable\Translatable;
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'actions';
    public $timestamps = true;
    public $translatedAttributes = ['name'];
    protected $fillable = ['code', 'name', 'status'];

    public function states() 
    {
        return $this->hasMany(ActionState::class);
    }
}

//Used for Translations
class ActionTranslation extends Model {

    protected $table = 'action_translations';
    public $timestamps = false;
    protected $fillable = ['name'];

}