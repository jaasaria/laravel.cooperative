<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrStockInItem extends Model
{
    protected  $table = 'tr_stock_in_item';
    protected  $fillable = [
		'stockin_id',
		'item_id',
		'qty',
		'cost',
		'subtotal',
    ];
    

    public function header()
    {
        return $this->belongsTo(TrStockIn::class);
    }
}
