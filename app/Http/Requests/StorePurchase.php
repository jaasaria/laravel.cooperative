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
            'code'=>'required|max:100|min:3|unique:tr_purchases',
            'supplier_id'=>'required|exists:tbl_supplier,id', 

            'description'=>'max:255', 
            'datePurchase'=>'required|date', 
            'dateDelivery'=>'required|date', 

            'trTotal'=>'required|min:1|numeric', 
        ];
    }


    public function sanitize()
    {
        return $this->all();
    }




}
