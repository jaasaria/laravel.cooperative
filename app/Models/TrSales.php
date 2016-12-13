<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TrSales extends Model
{
    protected  $table = 'tr_sales';
    protected  $fillable = [
		'trcode',
		'customer_id',
		'dateSales',
		'trsubtotal',
		'trdiscount',
		'trtotal',
		'description',
		'active',
    ];


    public function rows()
    {
        return $this->hasMany(TrSalesItem::class,'sales_id');
    }

    public function tbl_customer()
    {
        return $this->belongsTo(RefCustomer::class,'customer_id');
    }


}
