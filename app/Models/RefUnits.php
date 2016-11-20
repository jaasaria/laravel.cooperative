<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefUnits extends Model
{
    
    protected  $table = 'tbl_units';
    protected  $fillable = ['name','description'];

}
