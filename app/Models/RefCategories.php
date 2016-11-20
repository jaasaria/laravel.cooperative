<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefCategories extends Model
{
    
    protected  $table = 'tbl_categories';
    protected  $fillable = ['name','description'];

}
