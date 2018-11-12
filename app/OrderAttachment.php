<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAttachment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_attachments';
    public $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'order_id',
    	'user_id',
    	'attachment_doc',
    	'comment_doc',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
