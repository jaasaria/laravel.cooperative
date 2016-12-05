<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrPurchasesItem extends Model
{
    
    protected  $table = 'tr_purchasesItem';
    protected  $fillable = [
		'trcode',
		'purchase_id',
		'item_id',
		'qty',
		'cost',
		'subtotal',
    ];
    

    public function header()
    {
        return $this->belongsTo(TrPurchases::class);
    }
}

