<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TrStockIn extends Model
{
 

 protected  $table = 'tr_stock_in';
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
        return $this->hasMany(TrStockInItem::class,'stockin_id');
    }

    public function tbl_supplier()
    {
        return $this->belongsTo(RefSupplier::class,'supplier_id');
    }


   
}
