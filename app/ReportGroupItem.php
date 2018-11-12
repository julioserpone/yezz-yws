<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportGroupItem extends Model
{

    use \Dimsav\Translatable\Translatable;
    use SoftDeletes;
	protected $table = 'report_group_items';
    public $timestamps = true;
    public $translatedAttributes = ['name'];
    protected $fillable = ['report_group_id','code', 'name','value','order'];

    //
    public function reportItems() 
    {
        return $this->hasMany('App\ReportItems');
    }

}    //Used for Translations


class ReportGroupItemTranslation extends Model {

    protected $table = 'report_group_item_trans';
    public $timestamps = false;
    protected $fillable = ['name'];

}



