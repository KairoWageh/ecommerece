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
        if($attributes['trademarkIcon']) {
            $attributes['trademarkIcon'] = up()->upload([
                'file' => 'trademarkIcon',
                'path' => 'tradeMarks',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }
        $tradeMark = $model->create($attributes);
        return $tradeMark;
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
