<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','token','verified',
        'middlename', 'lastname', 'address','mobile','active','notes','avatar','last_login','designation'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

  protected $dates = [
        'created_at',
        'updated_at',
        'last_login'
    ];

    public function UpdateVerified(){
            $this->verified = true;
            $this->token = null;
            $this->save();
    }


    public function scopeVerified()
    {
        return $query->where('verified', '=', true);
    }



    public function getFullNameAttribute() {
        return ucwords($this->name) . ' ' . ucwords($this->middlename). ' ' . ucwords($this->lastname);
    }

}
