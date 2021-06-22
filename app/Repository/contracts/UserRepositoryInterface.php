<?php

namespace App\Repository\contracts;

/**
 * Interface UserRepositoryInterface
 * @package App\Repository\contracts
 */
interface UserRepositoryInterface{
    /**
     * @param $attributes
     * @param $model
     * @return mixed
     */
    public function store($attributes, $model);
}
