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
            'department_id.gt'       => __('department_id_required'),
            'content.required'       => __('content_required'),
            'content.min'            => __('content_min'),
            'content.max'            => __('content_max'),
        ];
        $productRequest = new ProductRequest(null, 'store');
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

    public function save_product_settings($model, $id, $attributes){
        $messages = [
            'price.required'               => __('price_required'),
            'price.numeric'                => __('price_numeric'),
            'price.gt'                     => __('price_gt'),
            'stock.required'               => __('stock_required'),
            'stock.numeric'                => __('stock_numeric'),
            'stock.gt'                     => __('stock_gt'),
            'start_at.required'            => __('start_at_required'),
            'start_at.date'                => __('start_at_date'),
            'start_at.after_or_equal'      => __('start_at_after_or_equal'),
            'end_at.required'              => __('end_at_required'),
            'end_at.date'                  => __('end_at_date'),
            'end_at.after'                 => __('end_at_after'),
//            'offer_price.required'       => __('offer_price_required'),
            'offer_price.numeric'          => __('offer_price_numeric'),
            'offer_price.gt'               => __('offer_price_gt'),
            'offer_price.lt'               => __('offer_price_lt'),
            'start_offer_at.required_with' => __('start_offer_at_required'),
            'start_offer_at.date'          => __('start_offer_at_date'),
            'start_offer_at.after'         => __('start_offer_at_after'),
            'start_offer_at.before'        => __('start_offer_at_before'),
            'end_offer_at.required_with'   => __('end_offer_at_required'),
            'end_offer_at.date'            => __('end_offer_at_date'),
            'end_offer_at.after'           => __('end_offer_at_after'),
            'end_offer_at.before'          => __('end_offer_at_before'),
            'product_status.required'      => __('product_status_required'),
        ];
        $productRequest = new ProductRequest($id, 'save_product_settings');
        $validator = Validator::make($attributes, $productRequest->rules(), $messages)->validate();
        Product::where('id', $id)->update($attributes);
        $product = self::find($model, $id);
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
