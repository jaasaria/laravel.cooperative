<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessages extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'messages'=>'required|max:1000', 
        ];
    }

    public function sanitize()
    {
        return $this->all();
    }


}
