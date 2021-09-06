<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    protected $id;
    protected $request_type;

    public function __construct($id, $request_type){
        $this->id = $id;
        $this->request_type = $request_type;
    }

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
        if($this->request_type == 'store'){
            $rules = [
                'name'                  => 'required|min:3|max:50',
                'email'                 => 'required|email|unique:admins',
                'level'                 => 'required',
                'password'              => 'required|min:8',
            ];
        }

        if($this->request_type == 'update'){
            $rules = [
                'edit_name'             => 'required|min:3|max:50',
                'edit_email'            => 'required|email|unique:admins,email,'.$this->id,
                'edit_password'         => 'nullable|min:8',
            ];
        }
        return $rules;
    }
}
