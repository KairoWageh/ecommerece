<?php
namespace App\Repository\contracts;

/**
 * Interface BaseRepositoryInterface
 * @package App\Repository\contracts
 */
interface BaseRepositoryInterface{
    /**
     * @param $model
     * @return mixed
     */
    public function all($model);

    /**
     * @param $model
     * @param $id
     * @return mixed
     */
    public function find($model, $id);
}
