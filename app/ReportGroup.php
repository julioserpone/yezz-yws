<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportGroup extends Model
{
	use SoftDeletes;
    protected $fillable = ['name'];
	protected $table = 'report_groups';



}
