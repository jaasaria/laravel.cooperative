<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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


        //added this code because of two identification code (id and code)
        if ($this->method() == 'PUT')
        {
            $email_rule = 'required|unique:users,email,' . $this->get('id') ;
            $password_rule = '';
        }
        else
        {
            $email_rule = 'required|unique:users|email';
            $password_rule = 'required|min:6|confirmed';
        }

        return [
            'email'=>$email_rule, 
            'password'=> $password_rule, 

            'name'=>'required|max:100|min:3', 
            'middlename'=>'required|max:100|min:3', 
            'lastname'=>'required|max:100|min:3', 

            'designation'=>'required|max:255', 
            'address'=>'required|min:3|max:255', 
            'mobile'=>'required|min:3|max:255', 

            'notes'=>'max:255', 
         
            
        ];
    }

    public function sanitize()
    {
        return $this->all();
    }




}
