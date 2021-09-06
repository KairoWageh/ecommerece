<?php

namespace App\Repository\sql;

use App\Repository\contracts\CountryRepositoryInterface;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface{

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
}
