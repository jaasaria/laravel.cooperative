<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrSettings extends Model
{
    
	protected  $table = 'tr_settings';
    protected  $fillable = [
		'field',
		'value',
		'description',
    ];
    


}
