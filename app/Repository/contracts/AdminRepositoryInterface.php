<?php

namespace App\Repository\contracts;

interface AdminRepositoryInterface{

    /**
     * @param $attributes
     * @param $model
     * @return mixed
     */
    public function store($attributes, $model);
}
