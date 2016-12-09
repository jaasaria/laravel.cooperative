<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefRole extends Model
{
    protected  $table = 'tbl_role';
    protected  $fillable = ['name',
			'description'
    ];



}
