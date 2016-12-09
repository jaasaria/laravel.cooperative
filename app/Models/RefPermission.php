<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefPermission extends Model
{
    protected  $table = 'tbl_permission';
    protected  $fillable = ['name',
			'value'
    ];


    public function getPermissionRuleAttribute(){
    	return explode(',', $this->value);
    }


}
