<?php

namespace App\Repository\contracts;

interface ProductRepositoryInterface{

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
