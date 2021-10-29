<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $todayDate = date('m/d/Y');
        if($this->request_type == 'store'){
            $rules = [
                'title'         => 'required|min:3|max:50',
                'department_id' => 'required|gt:0',
                'content'       => 'required|min:10|max:500',
            ];
        }

        if($this->request_type == 'save_product_settings'){
            $rules = [
                'price'          => 'required|numeric|gt:0',
                'stock'          => 'required|numeric|gt:0',
                'start_at'       => 'required|date|after_or_equal:'.$todayDate,
                'end_at'         => 'required|date|after:start_at',
//                'offer_price'    => 'sometimes|numeric|gt:0|lt:price',
//                'start_offer_at' => 'required_with:offer_price|date|after:start_at|before:end_at',
//                'end_offer_at'   => 'required_with:offer_price|date|after:start_offer_at|before:end_at',
                'product_status' => 'required|in:pending,refused,active'
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
