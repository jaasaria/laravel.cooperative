<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $this->post = Post::findOrFail($this->input('id', 0); //default ID to 0, if not sent through form.
        // if ($this->user->id !== $this->post->user_id) {
        //      $this->error = 'Sorry, you do not have permission to edit this post';
        //      return false;
        // }
        return true;
    }

    /**
     * This method will be invoked if authorize() fails
     */
    public function forbiddenResponse()
    {
        return redirect('error')->with('error_message', $this->error);
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:100|min:3', 
            'description'=>'max:255', 
        ];
    }

    public function sanitize()
    {
        return $this->all();
    }


}
