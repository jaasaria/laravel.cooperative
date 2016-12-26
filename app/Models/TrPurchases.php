<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TrPurchases extends Model
{
    
    protected  $table = 'tr_purchases';
    protected  $fillable = [
		'trcode',
		'supplier_id',
		'datePurchase',
		'dateDelivery',
		'trsubtotal',
		'trdiscount',
		'trtotal',
		'description',
		'active',
    ];

    protected $appends = ['datePurchase','dateDelivery'];

    public function getDatePurchaseAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }
    public function getDateDeliveryAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }


    public function rows()
    {
        return $this->hasMany(TrPurchasesItem::class,'purchase_id');
    }

    public function tbl_supplier()
    {
        return $this->belongsTo(RefSupplier::class,'supplier_id');
    }


}
