<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefCustomer extends Model
{
    protected  $table = 'tbl_customer';
    protected  $fillable = ['name',
		    'address',
		    'shippingAddress',
			'telno',
			'mobileno',
			'faxno',
			'website',
			'email',
			'notes',
			'active'
    ];
}
