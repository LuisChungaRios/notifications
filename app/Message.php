<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Message extends Model
{
    protected $guarded = ['id'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
