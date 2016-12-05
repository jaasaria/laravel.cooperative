<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchase extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'trcode'=>'required|alpha_dash|unique:tr_purchases|min:3',
            'supplier_id'=>'required|exists:tbl_supplier,id', 
            'description'=>'max:255', 
            'datePurchase'=>'required|date_format:m/d/Y', 
            'dateDelivery'=>'required|date_format:m/d/Y', 
            'trtotal'=>'required|min:1|numeric', 
            'rows.*.item_id' => 'required|max:255',
            'rows.*.cost' => 'required|numeric|min:1',
            'rows.*.qty' => 'required|integer|min:1'
            
        ];
    }


    public function sanitize()
    {
        return $this->all();
    }




}
