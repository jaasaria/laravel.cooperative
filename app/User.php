<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\TrMessages;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','token','verified','chat_status',
        'middlename', 'lastname', 'address','mobile','active','notes','avatar','last_login','designation'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'last_login'
    ];

    protected $appends = array('UserAvatar','fullname','ChatStat');

    public function UpdateVerified(){
            $this->verified = true;
            $this->token = null;
            $this->save();
    }

    // public function receiverMessage(){
    //     return $this->hasMany(TrMessages::class,'receiver_id');
    // }

    public function scopeVerified()
    {
        return $query->where('verified', '=', true);
    }
    public function getFullNameAttribute() {
        return ucwords($this->name) . ' ' . ucwords($this->middlename). ' ' . ucwords($this->lastname);
    }
    public function getChatStatAttribute(){

        $stat = '';
        switch ($this->chat_status) {
        case 0:
            $stat =  "Available";
            break;
        case 1:
            $stat =  "Busy";
            break;
        case 2:
            $stat =  "Away";
            break;
        default:
            $stat =  "No Status Found";
        }

        return  $stat;
    }

    public function getUserAvatarAttribute(){
        return asset("upload/avatars")  . '/' . $this->avatar ; 
    }







}
