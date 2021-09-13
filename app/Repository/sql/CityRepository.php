<?php

namespace App\Repository\sql;

use App\City;
use App\Country;
use App\Http\Requests\CityRequest;
use App\Repository\contracts\CityRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class CityRepository extends BaseRepository implements CityRepositoryInterface{

    public function allCities($model)
    {
//        $countries = Country::select('*')->get();
//        $select = [];
//        foreach($countries as $country){
//            if(session('lang') == 'ar'){
//                $select[$country->id] = $country->country_name_ar;
//            }else{
//                $select[$country->id] = $country->country_name_en;
//            }
//        }
        return $model::with('country');
    }

    public function store($attributes, $model){
        $messages = [
            'city_name_ar.required'   => __('name_required'),
            'city_name_ar.min'        => __('name_min'),
            'city_name_ar.max'        => __('max'),
            'city_name_en.required'   => __('name_required'),
            'city_name_en.min'        => __('name_min'),
            'city_name_en.max'        => __('max'),
            'country_id.required'     => __('required'),
            'country_id.numeric'      => __('numeric')
        ];
        $cityRequest = new CityRequest();
        $validator = Validator::make($attributes, $cityRequest->rules(), $messages)->validate();
        $city = $model->create([
            'city_name_ar' => $attributes['city_name_ar'],
            'city_name_en' => $attributes['city_name_en'],
            'country_id'   => $attributes['country_id'],
        ]);
        if($city != null){
            // get country name according to the current app language
            $country = Country::find($city->country_id);
            $lang = app()->getLocale();
            $name = 'country_name_'.$lang;
            // assign country name to the city
            $city->country_name = $country->$name;
            $city->created_at = date('Y-m-d H:i', strtotime($city->created_at) );
            $city->updated_at = date('Y-m-d H:i', strtotime($city->updated_at) );
        }
        return $city;
    }

    /**
     * @param $attributes
     * @param $model
     * @param $id
     * @return mixed|void
     */
    public function update($attributes, $model, $id)
    {
        $messages = [
            'city_name_ar.required'   => __('name_required'),
            'city_name_ar.min'        => __('name_min'),
            'city_name_ar.max'        => __('max'),
            'city_name_en.required'   => __('name_required'),
            'city_name_en.min'        => __('name_min'),
            'city_name_en.max'        => __('max'),
            'country_id.required'     => __('required'),
            'country_id.numeric'      => __('numeric')
        ];
        $cityRequest = new CityRequest();
        $validator = Validator::make($attributes, $cityRequest->rules(), $messages)->validate();
        $update_city_data = [
            'city_name_ar'  => $attributes['city_name_ar'],
            'city_name_en'  => $attributes['city_name_en'],
            'country_id'    => $attributes['country_id'],
        ];
        $updated = City::where('id', $id)->update($update_city_data);
        if($updated == 1){
            $city = self::find($model, $id);
            $country = Country::find($city->country_id);
            $lang = app()->getLocale();
            $name = 'country_name_'.$lang;
            $city->country_name = $country->$name;
        }
        return $city;
    }

    public function delete($model, $id){
        $city = self::find($model, $id);
        $states = $city->states;
        foreach ($states as $state) {
            $state->delete();
        }
        $deleted = $city->delete();
        return $deleted;
    }
}
