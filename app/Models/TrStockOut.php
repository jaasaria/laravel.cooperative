<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TrStockOut extends Model
{
 

 protected  $table = 'tr_stock_out';
    protected  $fillable = [
		'trcode',
		'supplier_id',
		'dateTrans',
		'trsubtotal',
		'trdiscount',
		'trtotal',
		'description',
		'active',
    ];

    protected $appends = ['dateTrans'];

    public function getDateTransAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }
  

    public function rows()
    {
        return $this->hasMany(TrStockOutItem::class,'stockout_id');
    }

    public function tbl_supplier()
    {
        return $this->belongsTo(RefSupplier::class,'supplier_id');
    }


   
}
