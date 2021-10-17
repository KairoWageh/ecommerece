<?php

namespace App\Repository\sql;

use App\Admin;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Repository\contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {
    /**
     * @param $attributes
     * @param $model
     * @return mixed|void
     */
    public function store($attributes, $model)
    {
        $messages = [
            'title.required'         => __('title_required'),
            'title.min'              => __('title_min'),
            'title.max'              => __('title_max'),
            'department_id.required' => __('department_id_required'),
            'content.required'       => __('content_required'),
            'content.min'            => __('content_min'),
            'content.max'            => __('content_max'),
        ];
        $productRequest = new ProductRequest();
        $validator = Validator::make($attributes, $productRequest->rules(), $messages)->validate();
        $product = $model->create([
            'title'         => $attributes['title'],
            'department_id' => $attributes['department_id'],
            'content'       => $attributes['content'],
        ]);
        if(isset($product)){
            $product->created_at = date('H:i Y-m-d', strtotime($product->created_at) );
            $product->updated_at = date('H:i Y-m-d', strtotime($product->updated_at) );
        }
        return $product;
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
