<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrSalesItem extends Model
{
 
  protected  $table = 'tr_salesItem';
    protected  $fillable = [
		'trcode',
		'sales_id',
		'item_id',
		'qty',
		'price',
		'subtotal',
    ];
    
    public function header()
    {
        return $this->belongsTo(TrSales::class);
    }
 
}
