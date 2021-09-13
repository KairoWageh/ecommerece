<?php

namespace App\Repository\sql;

use App\Country;
use App\Repository\contracts\CountryRepositoryInterface;
use App\Http\Requests\CountryRequest;
use Illuminate\Support\Facades\Validator;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface{
    /**
     * @param $model
     * @param $id
     * @return array|string[]
     */
    public function get_country_cities($model, $id)
    {
        $country = $model::find($id);
        $country_cities = $country->cities;
        if(count($country_cities) > 0){
            foreach ($country_cities as $city){
                $lang = app()->getLocale();
                $name = 'city_name_'.$lang;
                // assign country name to the city
                $city->city_name = $city->$name;
            }
            $data = [
                'cities' => $country_cities
            ];
        }else{
            $data = [
                'cities' => 'no cities'
            ];
        }
        return $data;
    }
    /**
     * @param $attributes
     * @param $model
     * @return mixed|void
     */
    public function store($attributes, $model)
    {
        $messages = [
            'country_name_ar.required'  => __('name_required'),
            'country_name_ar.min'       => __('name_min'),
            'country_name_ar.max'       => __('name_max'),
            'country_name_en.required'  => __('name_required'),
            'country_name_en.min'       => __('name_min'),
            'country_name_en.max'       => __('name_max'),
            'country_code.required'     => __('country_code_required'),
            'country_iso_code.required' => __('country_iso_code_required'),
            'country_currency.required' => __('country_currency_required'),
            'country_flag.required'     => __('country_flag_required'),
            'country_flag.max'          => __('country_flag_max'),
        ];
        $countryRequest = new CountryRequest('create');
        $validator = Validator::make($attributes, $countryRequest->rules(), $messages)->validate();
        $country = $model->create([
            'country_name_ar'     => $attributes['country_name_ar'],
            'country_name_en'    => $attributes['country_name_en'],
            'country_code' => $attributes['country_code'],
            'country_iso_code'    => $attributes['country_iso_code'],
            'country_currency' => $attributes['country_currency'],
            'country_flag'     => $attributes['country_flag']
        ]);
        if(isset($attributes['country_flag'])){
            $attributes['country_flag'] = up()->upload([
                'file'        => 'country_flag',
                'path'        => 'countries_flags',
                'upload_type' => 'single',
                'delete_file' => $country->country_flag,
            ]);
        }
        if(isset($country)){
            $country->created_at = date('H:i Y-m-d', strtotime($country->created_at) );
            $country->updated_at = date('H:i Y-m-d', strtotime($country->updated_at) );
        }
        return $country;
    }
    /**
     * @param $attributes
     * @param $model
     * @param $id
     * @return array
     */
    public function update($attributes, $model, $id)
    {
        $messages = [
            'country_name_ar.required'  => __('name_required'),
            'country_name_ar.min'       => __('name_min'),
            'country_name_ar.max'       => __('name_max'),
            'country_name_en.required'  => __('name_required'),
            'country_name_en.min'       => __('name_min'),
            'country_name_en.max'       => __('name_max'),
            'country_code.required'     => __('country_code_required'),
            'country_iso_code.required' => __('country_iso_code_required'),
            'country_currency.required' => __('country_currency_required'),
            'country_flag.required'     => __('country_flag_required'),
            'country_flag.max'          => __('country_flag_max'),
        ];

        $countryRequest = new CountryRequest();
        $validator = Validator::make($attributes, $countryRequest->rules(), $messages)->validate();
        $update_country_data = [
            'country_name_ar'  => $attributes['country_name_ar'],
            'country_name_en'  => $attributes['country_name_en'],
            'country_code'     => $attributes['country_code'],
            'country_iso_code' => $attributes['country_iso_code'],
            'country_currency' => $attributes['country_currency'],
        ];

        if(isset($attributes['country_flag'])){
            $attributes['country_flag'] = up()->upload([
                'file'        => 'country_flag',
                'path'        => 'countries_flags',
                'upload_type' => 'single',
                'delete_file' => Country::find($id)->country_flag,
            ]);
        }
        $updated = Country::where('id', $id)->update($update_country_data);
        if($updated == 1){
            $country = self::find($model, $id);
            $data = [
                'country'  => $country,
                'toast'    => 'success',
                'message'  => __('updated')
            ] ;
        }else{
            $data = [
                'toast'    => 'error',
                'message'  => __('not_updated')
            ] ;
        }
        return $data;
    }

    /**
     * @param $model
     * @param $id
     * @return array
     */
    public function delete($model, $id)
    {
        $country = self::find($model, $id);
        $deleted = $country->delete();
        if($deleted == 1){
            $data = [
                'toast'    => 'success',
                'message'  => __('deleted')
            ] ;
        }else{
            $data = [
                'toast'    => 'error',
                'message'  => __('not_deleted')
            ] ;
        }
        return $data;
    }
}
