<?php

namespace App\Repository\sql;

use App\Repository\contracts\BaseRepositoryInterface;


class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @param $model
     * @return mixed
     */
    public function all($model)
    {
        return $model->all();
    }

    /**
     * @param $model
     * @param $id
     * @return mixed
     */
    public function find($model, $id){
        return $model->find($id);
    }
}
