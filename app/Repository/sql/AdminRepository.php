<?php

namespace App\Repository\sql;

use App\Admin;
use App\Repository\contracts\AdminRepositoryInterface;

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

    /**
     * @param $attributes
     * @param $model
     * @param $id
     * @return array
     */
    public function update($attributes, $model, $id)
    {
        $update_admin_data = [
            'name' => $attributes->edit_name,
            'email' => $attributes->edit_email
        ];
        $updated = Admin::where('id', $id)->update($update_admin_data);
        if($updated == 1){
            $admin = self::find($model, $id);
            $data = [
                'admin'  => $admin,
                'toast'    => 'success',
                'message'  => __('updated')
            ] ;
        }else{
            $data = [
                'toast'    => 'error',
                'message'  => __('not_updated')
            ] ;
        }
        return $data;
    }

    public function delete($model, $id)
    {
        $admin = self::find($model, $id);
        $deleted = $admin->delete();
        if($deleted == 1){
            $data = [
                'toast'    => 'success',
                'message'  => __('deleted')
            ] ;
        }else{
            $data = [
                'toast'    => 'error',
                'message'  => __('not_deleted')
            ] ;
        }
        return $data;
    }
}
