<?php

namespace App\Repository\sql;

use App\Repository\contracts\TrademarkRepositoryInterface;

class TrademarkRepository extends BaseRepository implements TrademarkRepositoryInterface{
    /**
     * @param $attributes
     * @param $model
     * @return mixed|void
     */
    public function store($attributes, $model){
        $tradeMark = $model->create($attributes);
        if($tradeMark != null){
            $tradeMark->created_at = date('Y-m-d H:i', strtotime($tradeMark->created_at) );
            $tradeMark->updated_at = date('Y-m-d H:i', strtotime($tradeMark->updated_at) );
            $data = [
                'tradeMark'  => $tradeMark,
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
        $update_user_data = [
            'name' => $attributes->edit_name,
            'email' => $attributes->edit_email
        ];
        $updated = User::where('id', $id)->update($update_user_data);
        if($updated == 1){
            $updated_user = self::find($model, $id);
            $data = [
                'user'  => $updated_user,
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
        $user = self::find($model, $id);
        if($user != null){
            $user->delete();
            $data = [
                'toast'    => 'success',
                'message' => __('deleted')
            ];
        }else{
            $data = [
                'toast'    => 'error',
                'message' => __('admin.not_deleted')
            ];
        }
        return $data;
    }
}
