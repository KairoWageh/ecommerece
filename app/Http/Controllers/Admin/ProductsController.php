<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductMall;
use App\ProductOtherData;
use App\Size;
use App\Weight;
use App\DataTables\ProductsDataTable;
use Storage;
// use Upload;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDataTable $product)
    {
        /*
            data in datatable comes from CountriesDatatable query method
            not this method
        */

        //$data = User::latest()->get();
        $data = Product::select('*')->whereNotIn('status', [-1])->get();
        return $product->render('admin.products.index', ['title' => __('admin.productsController')]);
        // return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function($row){
        //             $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::create([
            'title'                   => '',
        ]);
        if(!empty($product)){
            return redirect('admin/products/'.$product->id.'/edit');
        }
        // return view('admin.products.product', ['title'=> trans("admin.add")]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'country_name_ar'     => 'required|min:3|max:50',
    //         'country_name_en'     => 'required|min:3|max:50',
    //         'country_code'        => 'required',
    //         'country_iso_code'    => 'required',
    //         'country_flag'        => 'required|max:10000|'.validate_image(),
    //     ]);
    //     //return $request;
    //     if($validatedData){
    //         if($request->hasFile('country_flag')){
    //             $validatedData['country_flag'] = up()->upload([
    //                 'file'        => 'country_flag',
    //                 'path'        => 'countries_flags',
    //                 'upload_type' => 'single',
    //                 'delete_file' => '',
    //             ]);
    //         }
    //         $validatedData['status'] = 1;
    //         Country::create($validatedData);
    //         session()->flash('success', __('admin.record_added_successfully'));
    //         return redirect(adminURL('admin/countries'));
    //     }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        // $title = __('admin.edit');
        // return view('admin.countries.edit', compact('country', 'title'));
        return view('admin.products.product', ['title' => trans("admin.create_or_edit_product", ['title' => $product->title]), 'product' => $product]);
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
        $product->photo = null;
        $product->save();
        return response(['status' => true], 200);
    }

    /**
    * product iamges
    */
    public function upload_file(Request $request, $id){
        if($request->hasFile('file')){

            // resize image
            $request->file('file')->resize(150, 100, function ($constraint) {
                $constraint->aspectRatio();
            });



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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
            'price'                  => 'required|numeric',
            'stock'                  => 'required|numeric',
            'start_at'               => 'required|date',
            'end_at'                 => 'required|date',
            'start_offer_at'         => 'sometimes|nullable|date',
            'end_offer_at'           => 'sometimes|nullable|date',
            'offer_price'            => 'sometimes|nullable|numeric',
            'weight'                 => 'sometimes|nullable',
            'weight_id'              => 'sometimes|nullable|numeric',
            'product_status'         => 'sometimes|nullable|in:pending, refused, active',
            'reason'                 => 'sometimes|nullable|numeric',
        ], [], [
            'title'                  => __('admin.product_title'),
            'content'                => __('admin.product_content'),
            'department_id'          => __('admin.department'),
            'trade_mark_id'          => __('admin.trademark'),
            'manu_id'                => __('admin.manufacture'),
            'color_id'               => __('admin.color'),
            'size'                   => __('admin.size'),
            'size_id'                => __('admin.size_id'),
            'currency_id'            => __('admin.currency'),
            'price'                  => __('admin.price'),
            'stock'                  => __('admin.stock'),
            'start_at'               => __('admin.start_at'),
            'end_at'                 => __('admin.end_at'),
            'start_offer_at'         => __('admin.start_offer_at'),
            'end_offer_at'           => __('admin.end_offer_at'),
            'offer_price'            => __('admin.offer_price'),
            'weight'                 => __('admin.weight'),
            'weight_id'              => __('admin.weight_id'),
            'product_status'         => __('admin.product_status'),
            'reason'                 => __('admin.reason'),
        ]);

        if(request()->has('mall')){
            ProductMall::where('product_id', $id)->delete();
            foreach (request('mall') as $mall) {
                ProductMall::create([
                    'product_id'  => $id,
                    'mall_id'     => $mall
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

        //return $validatedData;
        Product::where('id', $id)->update($validatedData);

        return response(['status' => true, 'message' => __('admin.updated_successfully')], 200);
        session()->flash('success', __('admin.updated_successfully'));
        return redirect(adminURL('products'));
        // if($validatedData){

        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        Storage::delete($product->photo);
        $product->status = -1;
        $product->photo = null;
        $product->save();
        // $cities = $country->cities;
        // $states = $country->states;
        // foreach ($cities as $city) {
        //     $city->status = -1;
        //     $city->save();
        // }
        // foreach ($states as $state) {
        //     $state->status = -1;
        //     $state->save();
        // }
        session()->flash('success', __('admin.delete_successfully'));
        return back();
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $countriesIDs = $request->item;
        foreach ($countriesIDs as $key => $countryID) {
            $country = Country::find($countryID);
            Storage::delete($country->country_flag);
            $country->status = -1;
            $country->country_flag = null;           
            $country->save();
            $cities = $country->cities;
            $states = $country->states;
            foreach ($cities as $city) {
                $city->status = -1;
                $city->save();
            }
            foreach ($states as $state) {
                $state->status = -1;
                $state->save();
            }
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
