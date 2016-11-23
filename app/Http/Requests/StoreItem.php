<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItem extends FormRequest
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


    if ($this->method() == 'PUT')
    {
        $code_rule = 'required|max:100|min:3|unique:tbl_item,code,' . $this->get('id')  ;
    }
    else
    {
        $code_rule = 'required|max:100|min:3|unique:tbl_item';
    }

        return [
            'code'=>$code_rule, 
            'name'=>'required|max:100|min:3', 
            'description'=>'max:255', 
            'cost'=>'required|numeric', 
            'price'=>'required|numeric', 
            'tax'=>'required|max:50|numeric', 

            'category_id'=>'required|exists:tbl_categories,id', 
            'unit_id'=>'required|exists:tbl_units,id', 
            
            // exists:states

        ];
    }
}
