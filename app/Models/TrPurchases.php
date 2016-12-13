<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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


    public function rows()
    {
        return $this->hasMany(TrPurchasesItem::class,'purchase_id');
    }

    public function tbl_supplier()
    {
        return $this->belongsTo(RefSupplier::class,'supplier_id');
    }


}
