<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnostic extends Model
{
     use \Dimsav\Translatable\Translatable;
     use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'diagnostics';
    public $timestamps = true;
    public $translatedAttributes = ['name'];
    protected $fillable = ['code', 'name', 'status'];

    public function states() 
    {
        return $this->hasMany(DiagnosticState::class);
    }
}

//Used for Translations
class DiagnosticTranslation extends Model {

    protected $table = 'diagnostic_translations';
    public $timestamps = false;
    protected $fillable = ['name'];

}