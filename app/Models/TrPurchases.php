<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrPurchases extends Model
{
    
    protected  $table = 'tr_purchases';
    protected  $fillable = [
		'code',
		'supplier_id',
		'purchaseDate',
		'deliveryDate',
		'total',
		'description',
		'active',
    ];

}
