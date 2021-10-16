<?php

namespace App\Http\Controllers\Admin;

use App\Repository\contracts\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use App\Product;
use App\ProductMall;
use App\ProductOtherData;
use App\File as FileTbl;
use App\Size;
use App\Weight;
use App\RelatedProduct;
use App\DataTables\ProductsDataTable;
use Illuminate\Http\Response;
use Storage;
use Cart;
use App\CartStorageModel;
// use Upload;

class ProductsController extends Controller
{
    protected $product;
    protected $model;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param Product $productModel
     */
    public function __construct(ProductRepositoryInterface $productRepository, Product $productModel){
        $this->product = $productRepository;
        $this->model = $productModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ProductsDataTable $product)
    {
        /*
            data in datatable comes from CountriesDatatable query method
            not this method
        */
        $data = Product::select('*')->get();
        return $product->render('admin.products', ['title' => __('productsController')]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.products.create', ['title' => trans("create_product")]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
     public function store(Request $request)
     {
         $attributes = [
             'title'    => $request->data['title'],
             'content'  => $request->data['content'],

         ];
         $product = $this->product->store($attributes, $this->model);
         if($product == true){
             $data = [
                 'product'  => $product,
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        // $title = __('admin.edit');
        // return view('admin.countries.edit', compact('country', 'title'));
        return view('admin.products.product', ['title' => trans("create_or_edit_product", ['title' => $product->title]), 'product' => $product]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title'                  => 'required',
            'content'                => 'required',
            'department_id'          => 'required|numeric',
            'trade_mark_id'          => 'required|numeric',
            'manu_id'                => 'required|numeric',
            'color_id'               => 'sometimes|nullable|numeric',
            'size'                   => 'sometimes|nullable',
            'size_id'                => 'sometimes|nullable|numeric',
            'currency_id'            => 'sometimes|nullable|numeric',
            'price'                  => 'required|numeric|min:1',
            'stock'                  => 'required|numeric',
            'start_at'               => 'required|date|before:end_at',
            'end_at'                 => 'required|date|after:start_at',
            'start_offer_at'         => 'required_unless,offer_price,0.00|sometimes|nullable|date|afterOrEqual:start_at|before:end_at|before:end_offer_at',
            'end_offer_at'           => 'required_unless,offer_price,0.00|sometimes|nullable|date|after:start_at|after:start_offer_at|beforeOrEqual:end_at',
            'offer_price'            => 'sometimes|nullable|numeric|lt:price',
            'weight'                 => 'sometimes|nullable',
            'weight_id'              => 'sometimes|nullable|numeric',
            'product_status'         => 'sometimes|nullable|in:pending,refused,active',
            'reason'                 => 'sometimes|nullable|numeric',
        ], [], [
            'title'                  => __('product_title'),
            'content'                => __('product_content'),
            'department_id'          => __('department'),
            'trade_mark_id'          => __('trademark'),
            'manu_id'                => __('manufacture'),
            'color_id'               => __('color'),
            'size'                   => __('size'),
            'size_id'                => __('size_id'),
            'currency_id'            => __('currency'),
            'price'                  => __('price'),
            'stock'                  => __('stock'),
            'start_at'               => __('start_at'),
            'end_at'                 => __('end_at'),
            'start_offer_at'         => __('start_offer_at'),
            'end_offer_at'           => __('end_offer_at'),
            'offer_price'            => __('offer_price'),
            'weight'                 => __('weight'),
            'weight_id'              => __('weight_id'),
            'product_status'         => __('product_status'),
            'reason'                 => __('reason'),
        ]);

        if(request(''))
        if(request()->has('mall')){
            ProductMall::where('product_id', $id)->delete();
            foreach (request('mall') as $mall) {
                ProductMall::create([
                    'product_id'  => $id,
                    'mall_id'     => $mall
                ]);
            }
        }

        if(request()->has('related_products')){
            RelatedProduct::where('product_id', $id)->delete();
            foreach (request('related_products') as $relatedProductID) {
                RelatedProduct::create([
                    'product_id'          => $id,
                    'related_product'     => $relatedProductID
                ]);
            }
        }

        if(request()->has('input_value') && request()->has('input_key')){
            $count = 0;
            $other_data = '';
            ProductOtherData::where('product_id', $id)->delete();
            foreach (request('input_key') as $key) {
                $data_value = !empty(request('input_value'))?request('input_value')[$count]:'';
                ProductOtherData::create([
                    'product_id'  => $id,
                    'data_key'    => $key,
                    'data_value'  => $data_value
                ]);
                // $other_data .= $key.':'.request('input_value')[$count].'|';
                $count++;
            }
            $validatedData['other_data'] = rtrim($other_data, '|');
        }

        Product::where('id', $id)->update($validatedData);

        return response(['status' => true, 'message' => __('admin.updated_successfully')], 200);
        // session()->flash('success', __('admin.updated_successfully'));
        // return redirect(adminURL('products'));
        // if($validatedData){

        // }
    }


    // copy an existing product into new one with its all data and images
    public function copy_product($id){
        if(request()->ajax()){
            $product_to_copy = Product::find($id);
            $product_to_copy_array = $product_to_copy->toArray();
            unset($product_to_copy_array['id']);
            $copied_product = Product::create($product_to_copy_array);
            if(!empty($product_to_copy_array['photo'])){
                $ext = \File::extension($product_to_copy_array['photo']);
                $new_path = 'products/'.$copied_product->id.'/'.\Str::random(30).'.'.$ext;
                // copy main image and save it in new folder for the copied product
                \Storage::copy($product_to_copy_array['photo'], $new_path);
                $copied_product->photo = $new_path;
                $copied_product->save();
            }

            // copy product malls
            $copy_malls = $product_to_copy->malls()->get();
            foreach ($copy_malls as $mall) {
                ProductMall::create([
                    'product_id' => $copied_product->id,
                    'mall_id'    => $mall->mall_id
                ]);
            }

            // copy other data

            $copy_other_data = $product_to_copy->other_data()->get();
            foreach ($copy_other_data as $other_data) {
                ProductOtherData::create([
                    'product_id' => $copied_product->id,
                    'data_key'   => $other_data->data_key,
                    'data_value' => $other_data->data_value
                ]);
            }
            // copy product images
            $files = $product_to_copy->files()->get();
            if(count($files) > 0){
                foreach ($files as $file) {
                    $hashName = \Str::random(30);
                    $ext = \File::extension($file->full_file);
                    $new_path = 'products/'.$copied_product->id.'/'.$hashName.'.'.$ext;
                    \Storage::copy($file->full_file, $new_path);
                    $add = FileTbl::create([
                        'name'        => $file->name,
                        'size'        => $file->size,
                        'file'        => $hashName,
                        'path'        => 'products/'.$copied_product->id,
                        'full_file'   => 'products/'.$copied_product->id.'/'.$hashName.'.'.$ext,
                        'mime_type'   => $file->mime_type,
                        'file_type'   => 'product',
                        'relation_id' => $copied_product->id
                    ]);
                }
            }

            return response(['status' => true, 'message' => __('admin.product_created'), 'id' => $copied_product->id], 200);
        }else{
            return redirect(adminURL('/'));
        }

    }

    public function deleteProduct($id){
        $product = Product::find($id);
        Storage::delete($product->photo);
        $product->status = -1;
        $product->photo = null;
        $product->save();
        // search by cart_product_id as the form productId_productTitle
        // $found = CartStorageModel::find($product->id.'_'.$product->title);
        // Cart::remove($found);
        up()->delete_files($id);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        /* get all cart data and search if product is found in order not to delete
         if it is found in any user's cart
         * if not found, delete it
        */
        $product = Product::find($id);
        $product_id = $product->id;
        $product_title = $product->title;
        $item_id = $product_id.'_'.$product_title;

        $all_cart_data = CartStorageModel::select('cart_data')->get();


        //return $all_cart_data;
        if($all_cart_data){
            foreach ($all_cart_data as $user_cart_data) {
                echo $user_cart_data.'<br><br><br>';
                foreach ($user_cart_data->cart_data as $key=>$user_cart_data_item) {
                    $user_cart_data_item_id = $user_cart_data_item->id;
                    $item_product_id_array = explode('_', $user_cart_data_item_id);
                    $item_product_id = $item_product_id_array[0];
                    if($item_product_id == $id){
                        // if item_product_id equals product id ==> delete $user_cart_data_item from cart
                        $cart_data = $user_cart_data->cart_data;
                        // echo 'user_cart_data before::: <br>'.$user_cart_data.'<br><br><br>';
                        // echo 'cart_data before::::::<br>'.$cart_data.'<br><br>';
                        unset($cart_data[$key]);
                        unset($user_cart_data['cart_data']);

                        // echo 'user_cart_data after::::::: <br>'.$user_cart_data.'<br><br><br>';
                        // echo 'cart_data after::::::<br>'.$cart_data.'<br><br>';

                    }
                    $user_cart_data->save();
                    echo $user_cart_data;
                }
                // echo $user_cart_data.'<br><br><br><br><br>';
                // echo gettype($user_cart_data).'<br><br><br><br><br>';
                // echo '<pre>'.$user_cart_data->cart_data.'<br><br><br><br><br><br><br><br></pre>';
                // $flight = CartStorageModel::find('cart_data')->get();

                // $flight->name = 'New Flight Name';

                // $flight->save();
                // $all_cart_data->update();
                $all_cart_data = CartStorageModel::select('cart_data')->get();
                echo $all_cart_data;
                //return $all_cart_data;
            }

        }else{
            return null;
        }

        $this->deleteProduct($id);

        session()->flash('success', __('admin.delete_successfully'));
        // return back();
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return Response
     */
    public function multi_delete(Request $request){
        if(is_array(request('item')))
            foreach (request('item') as $id) {
                $this->deleteProduct($id);
            }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }



    /**
    * product images
    */
    public function upload_file(Request $request, $id){
        if($request->hasFile('file')){
            $fid = up()->upload([
                'file'        => 'file',
                'path'        => 'products/'.$id,
                'upload_type' => 'files',
                'file_type'   => 'product',
                'relation_id' => $id,
            ]);
            return response(['status' => true, 'id' => $fid], 200);
        }
    }

    public function delete_file(Request $request){
        if($request->has('id')){
            up()->delete($request->id);
        }
    }
    /**
    * product main photo
    */
    public function update_product_image($id){
        $product = Product::where('id', $id)->update([
            'photo' => up()->upload([
                'file'        => 'file',
                'path'        => 'products/' .$id,
                'upload_type' => 'single',
                'delete_file' => '',
            ]),
        ]);
        return response(['status' => true], 200);
    }

    /**
    * delete product main image
    */
    public function delete_main_image($id){
        $product = Product::find($id);
        Storage::delete($product->photo);
        //$product->photo = null;
        $product->photo = "";
        $product->save();
        return response(['status' => true], 200);
    }


    /**
    * prepare shipping info
    *
    */
    public function loadShippingInfo(){
        if(request()->ajax() and request()->has('department_id')){
            $department_list = array_diff(explode(',', get_parent(request('department_id'))), [request('department_id')]);
            $sizes = Size::where('is_public', 'yes')
                ->whereIn('department_id', $department_list)
                ->orWhere('department_id', request('department_id'))
                ->pluck('name_' .session('lang'), 'id');
            // $size_2 = Size::where('department_id', request('department_id'))->pluck('name_' .session('lang'), 'id');


            // $sizes = array_merge(json_decode($size_1, true), json_decode($size_2, true));
            $weights = Weight::pluck('name_'.session('lang'), 'id');
            return view('admin.products.ajax.shippingInfo', [
                'sizes'   => $sizes,
                'weights' => $weights,
                'product' => Product::find(request('product_id'))
            ])->render();

        }else{
            return trans("admin.please_choose_department");
        }
    }


    public function search_product(){
        if(request()->ajax()){
            if(request()->has('search') && !empty(request('search'))){
                $relatedProduct = RelatedProduct::where('product_id', request('id'))->get(['related_product']);
                $products = Product::where('title', 'LIKE', '%'.request('search').'%')
                                    ->where('id', '!=', request('id'))
                                    ->whereNotIn('id', $relatedProduct)
                                    ->limit(10)->orderBy('id', 'desc')->get();
                return response(['status'         => true,
                                 'result'         => count($products) > 0 ?$products:'',
                                 'count'          => count($products),
                               ], 200);
            }
        }
    }


}
