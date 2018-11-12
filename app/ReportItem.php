<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportItem extends Model
{
   protected $fillable = ['report_id','report_group_item_id'];    //

   public function reportGroupItem()
    {
        return $this->belongsTo('App\ReportGroupItem');
    }
}
