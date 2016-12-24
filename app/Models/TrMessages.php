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

    // protected $appends = ['sFullname','sAvatar','rFullname','rAvatar'];

    //sender
    public function userSender(){
        return $this->belongsTo(User::class,'sender_id')->select('id','name', 'avatar');
    }
    // public function getSFullnameAttribute(){
    //     return $this->userSender->fullname;
    // }
    // public function getSAvatarAttribute(){
    //     return $this->userSender->avatar;
    // }


    // receiver
    public function userReceiver(){
    	return $this->belongsTo(User::class,'receiver_id')->select('id','name', 'avatar');
    }
    // public function getRFullnameAttribute(){
    //     return $this->userReceiver->fullname;
    // }
    // public function getRAvatarAttribute(){
    //     return $this->userReceiver->avatar;
    // }

}
