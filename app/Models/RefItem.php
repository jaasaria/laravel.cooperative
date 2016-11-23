<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefItem extends Model
{
    protected  $table = 'tbl_item';
    protected  $fillable = ['name',
		    'code',
			'description',
			'cost',
			'price',
			'qty',
			'tax',
			'barcode',
			'category_id',
			'unit_id',
			'active'
    ];



}
