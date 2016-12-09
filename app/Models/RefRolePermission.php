<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefRolePermission extends Model
{
    protected  $table = 'tbl_role_permission';
    protected  $fillable = ['role_id',
			'permission_id'
    ];



}
