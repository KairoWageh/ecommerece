<?php

namespace App\Repository\sql;

use App\Repository\contracts\UserRepositoryInterface;
use App\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface{
    /**
     * @param $attributes
     * @param $model
     * @return mixed|void
     */
    public function store($attributes, $model){
        $attributes->password = bcrypt($attributes->password);
        $user = $model->create([
            'name'     => $attributes['name'],
            'email'    => $attributes['email'],
            'password' => $attributes->password,
            'level'    => $attributes['level'],
        ]);
//        $user->created_at = date('Y-m-d H:i', strtotime($user->created_at) );
//        $user->updated_at = date('Y-m-d H:i', strtotime($user->updated_at) );
        if($user != null){
//            var_dump($user);
            $user->created_at = date('Y-m-d H:i', strtotime($user->created_at) );
            $user->updated_at = date('Y-m-d H:i', strtotime($user->updated_at) );
            $data = [
                'user'  => $user,
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
