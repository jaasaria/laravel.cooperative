<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrStockOutItem extends Model
{
    protected  $table = 'tr_stock_out_item';
    protected  $fillable = [
		'stockout_id',
		'item_id',
		'qty',
		'cost',
		'subtotal',
    ];
    

    public function header()
    {
        return $this->belongsTo(TrStockOut::class);
    }
}
