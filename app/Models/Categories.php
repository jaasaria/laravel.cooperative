<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    
    protected  $table = 'tbl_categories';
    protected  $fillable = ['name','description'];

}
