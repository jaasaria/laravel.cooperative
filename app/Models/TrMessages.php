<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class TrMessages extends Model
{
    protected  $table = 'tr_messages';
    protected  $fillable = [
		'sender_id',
		'receiver_id',
		'messages',
		'seen',
		'create_at',
    ];



    public function userSender(){
    	return $this->belongsTo(User::class,'sender_id')->select(array('id','name','lastname','avatar'));
    }

    public function userReceiver(){
    	return $this->belongsTo(User::class,'receiver_id')->select(array('id','name','lastname','avatar'));
    }



}
