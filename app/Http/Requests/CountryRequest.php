<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    protected $request_type;

    public function __construct($request_type = null)
    {
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
        $rules = [
                'country_name_ar'  => 'required|min:3|max:50',
                'country_name_en'  => 'required|min:3|max:50',
                'country_code'     => 'required',
                'country_iso_code' => 'required',
                'country_currency' => 'required',
            ];

        if($this->request_type == 'create'){
            $rules += [
                'country_flag'     => 'required|max:10000|'.validate_image()
            ];
        }
        return $rules;
    }
}
