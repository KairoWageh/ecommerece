<?php

namespace App\Repository\sql;

use App\Repository\contracts\UserRepositoryInterface;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;


class UserRepository extends BaseRepository implements UserRepositoryInterface{
    /**
     * @param $attributes
     * @param $model
     * @return mixed|void
     */
    public function store($attributes, $model){
        $messages = [
            'name.required'      => __('name_required'),
            'name.min'           => __('name_min'),
            'email.required'     => __('email_required'),
            'email.email'        => __('email_email'),
            'email.unique'       => __('email_unique'),
            'level.required'     => __('level_required'),
            'password.required'  => __('password_required'),
            'password.min'       => __('password_min'),
        ];

        $userRequest = new UserRequest(null, 'store');
        $validator = Validator::make($attributes, $userRequest->rules(), $messages)->validate();
        $attributes['password'] = bcrypt($attributes['password']);

        $user = $model->create([
            'name'     => $attributes['name'],
            'email'    => $attributes['email'],
            'password' => $attributes['password'],
            'level'    => $attributes['level'],
        ]);

        if($user != null){
            $user->created_at = date('Y-m-d H:i', strtotime($user->created_at) );
            $user->updated_at = date('Y-m-d H:i', strtotime($user->updated_at) );
        }
        return $user;
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
        ];

        $userRequest = new UserRequest($id, 'update');
        $validator = Validator::make($attributes, $userRequest->rules(), $messages)->validate();
        $attributes['password'] = bcrypt($attributes['password']);
        $update_user_data = [
            'name' => $attributes['edit_name'],
            'email' => $attributes['edit_email']
        ];
        $updated = User::where('id', $id)->update($update_user_data);
        $user = self::find($model, $id);
        return $user;
    }

    public function delete($model, $id)
    {
        $user = self::find($model, $id);

        return $user;
    }
}
