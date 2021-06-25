<?php

namespace App\Repository\sql;

use App\City;
use App\Country;
use App\Repository\contracts\CityRepositoryInterface;

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
        $city = $model->create([
            'city_name_ar'     => $attributes['city_name_ar'],
            'city_name_en'    => $attributes['city_name_en'],
            'country_id' => $attributes['country_id'],
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
            $data = [
                'city'  => $city,
                'toast'    => 'success',
                'message'  => __('created')
            ] ;
        }else{
            $data = [
                'toast'    => 'error',
                'message'  => __('not_created')
            ] ;
        }
        return $data;
    }

    /**
     * @param $attributes
     * @param $model
     * @param $id
     * @return mixed|void
     */
    public function update($attributes, $model, $id)
    {
        $update_city_data = [
            'city_name_ar' => $attributes['edit_city_name_ar'],
            'city_name_en' => $attributes['edit_city_name_en'],
            'country_id'   => $attributes['edit_country_id'],
        ];
        $updated = City::where('id', $id)->update($update_city_data);
        if($updated == 1){
            $city = self::find($model, $id);
            $country = Country::find($city->country_id);
            $lang = app()->getLocale();
            $name = 'country_name_'.$lang;
            $city->country_name = $country->$name;
            $data = [
                'city'  => $city,
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

    public function delete($model, $id){
        $city = self::find($model, $id);
        $states = $city->states;
        foreach ($states as $state) {
            $state->delete();
        }
        $deleted = $city->delete();
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
