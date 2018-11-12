<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosticState extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'diagnostic_states';
    protected $fillable = ['diagnostic_id', 'state_id', 'status'];

    public function diagnostic()
    {
        return $this->belongsTo('App\Diagnostic');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
