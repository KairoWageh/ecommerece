<?php

namespace App\Repository\sql;

use App\Repository\contracts\AdminRepositoryInterface;
use Illuminate\Http\Request;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface {

    /**
     * @param $attributes
     * @param $model
     * @return mixed|void
     */
    public function store($attributes, $model)
    {
        $attributes->password = bcrypt($attributes->password);
        $admin = $model->create([
            'name'     => $attributes['name'],
            'email'    => $attributes['email'],
            'password' => $attributes->password,
        ]);

        if($admin != null){
            $admin->created_at = date('Y-m-d H:i', strtotime($admin->created_at) );
            $admin->updated_at = date('Y-m-d H:i', strtotime($admin->updated_at) );
            $data = [
                'admin'  => $admin,
                'toast'    => 'success',
                'message'  => __('created')
            ] ;
        }else{
            $data = [
                'toast'    => 'error',
                'message'  => __('not_created')
            ] ;
        }
        return $data;
    }
}
