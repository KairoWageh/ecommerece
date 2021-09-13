<?php

namespace App\Repository\contracts;

/**
 * Interface CountryRepositoryInterface
 * @package App\Repository\contracts
 */
interface CountryRepositoryInterface{

public function get_country_cities($model, $id);

    /**
     * @param $attributes
     * @param $model
     * @return mixed
     */
    public function store($attributes, $model);

    /**
     * @param $attributes
     * @param $model
     * @param $id
     * @return mixed
     */
    public function update($attributes, $model, $id);

    /**
     * @param $model
     * @param $id
     * @return mixed
     */
    public function delete($model, $id);
}
