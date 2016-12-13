<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrMessages extends Model
{
    protected  $table = 'tr_messages';
    protected  $fillable = [
		'sender_id',
		'receiver_id',
		'messages',
		'seen',
    ];

}
