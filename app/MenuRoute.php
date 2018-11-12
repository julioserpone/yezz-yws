<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuRoute extends Model
{
 	use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['parent_id', 'code', 'route', 'icon', 'roles'];
}


//Used for Translations
class MenuRouteTranslation extends Model {

    public $timestamps = false;
    protected $fillable = ['name'];

}
