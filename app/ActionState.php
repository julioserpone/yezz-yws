<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActionState extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'action_states';
    protected $fillable = ['action_id', 'state_id', 'status'];

    public function action()
    {
        return $this->belongsTo('App\Action');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
