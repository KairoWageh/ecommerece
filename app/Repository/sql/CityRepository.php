<?php

namespace App\Repository\sql;

use App\Repository\contracts\CityRepositoryInterface;

class CityRepository extends BaseRepository implements CityRepositoryInterface{

    public function allCities($model)
    {
        return $model->all()->with('country');
    }
}
