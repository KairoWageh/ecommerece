<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
                'name'                  => 'required|min:3',
                'email'                 => 'required|email|unique:admins',
                'password'              => 'required|min:8',
                'password_confirmation' => 'required|same:password',
            ];
        }

        if($this->request_type == 'update'){
            $rules = [
                'name'             => 'required|min:3',
                'email'            => 'required|email|unique:admins,email,'.$this->id,
                'password'         => 'nullable|min:8',
            ];
        }
        return $rules;
    }
}
