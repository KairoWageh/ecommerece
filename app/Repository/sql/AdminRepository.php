<?php

namespace App\Repository\sql;

use App\Admin;
use App\Http\Requests\AdminRequest;
use App\Repository\contracts\AdminRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface {
    /**
     * @param $attributes
     * @param $model
     * @return mixed|void
     */
    public function store($attributes, $model)
    {
        $messages = [
            'name.required'      => __('name_required'),
            'name.min'           => __('name_min'),
            'email.required'     => __('email_required'),
            'email.email'        => __('email_email'),
            'email.unique'       => __('email_unique'),
            'password.required'  => __('password_required'),
            'password.min'       => __('password_min'),
            'password_confirmation.required' => __('password_confirmation_required'),
            'password_confirmation.same' => __('password_confirmation_same'),
        ];
        $adminRequest = new AdminRequest(null, 'store');
        $validator = Validator::make($attributes, $adminRequest->rules(), $messages)->validate();
        $attributes['password'] = bcrypt($attributes['password']);
        $admin = $model->create([
            'name'     => $attributes['name'],
            'email'    => $attributes['email'],
            'password' => $attributes['password'],
        ]);
        if(isset($admin)){
            $admin->created_at = date('H:i Y-m-d', strtotime($admin->created_at) );
            $admin->updated_at = date('H:i Y-m-d', strtotime($admin->updated_at) );
        }
        return $admin;
    }

    /**
     * @param $type
     * @param $attributes
     * @param $model
     * @return mixed|void
     */
    public function social_login($type, $attributes, $model)
    {
        $attributes['password'] = bcrypt($attributes['password']);
        $admin = $model->create([
            'name'     => $attributes['name'],
            'email'    => $attributes['email'],
            $type      => $attributes[$type],
            'password' => $attributes['password'],
        ]);
        return $admin;
    }

    /**
     * @param $attributes
     * @param $model
     * @param $id
     * @return array
     */
    public function update($attributes, $model, $id)
    {
        $messages = [
            'name.required'      => __('name_required'),
            'name.min'           => __('name_min'),
            'email.required'     => __('email_required'),
            'email.email'        => __('email_email'),
            'email.unique'       => __('email_unique'),
            'password.min'       => __('password_min'),
        ];

        $adminRequest = new AdminRequest($id, 'update');
        $validator = Validator::make($attributes, $adminRequest->rules(), $messages)->validate();
        $attributes['password'] = bcrypt($attributes['password']);
        $update_admin_data = [
            'name' => $attributes['name'],
            'email' => $attributes['email']
        ];
        Admin::where('id', $id)->update($update_admin_data);
        $admin = self::find($model, $id);
        return $admin;
    }
    /**
     * @param $model
     * @param $id
     * @return array
     */
    public function delete($model, $id)
    {
        $admin = self::find($model, $id);
        return $admin;
    }
}
