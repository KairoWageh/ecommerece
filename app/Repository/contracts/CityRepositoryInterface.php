<?php

namespace App\Repository\contracts;

/**
 * Interface CityRepositoryInterface
 * @package App\Repository\contracts
 */
interface CityRepositoryInterface{

    /**
     * @param $model
     * @return mixed
     */
    public function allCities($model);
}
