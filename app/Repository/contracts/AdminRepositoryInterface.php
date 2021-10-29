<?php

namespace App\Repository\contracts;

interface AdminRepositoryInterface{

    /**
     * @param $attributes
     * @param $model
     * @return mixed
     */
    public function store($attributes, $model);

    /**
     * @param $type
     * @param $attributes
     * @param $model
     * @return mixed
     */
    public function social_login($type, $attributes, $model);

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
