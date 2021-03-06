<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\MallsDatatable;
use App\Mall;
use App\Country;
use Storage;

class MallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MallsDatatable $mall)
    {
        /*
            data in datatable comes from MallsDatatable query method
            not this method
        */
        $data = Mall::select('*')->get();
        return $mall->render('admin.malls', ['title' => __('mallsController')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$countries = Country::select('*')->whereNotIn('status', [-1])->get();
    	$select_country = [];
		foreach($countries as $country){
			if(session('lang') == 'ar'){
				$select_country[$country->id] = $country->country_name_ar;
			}else{
				$select_country[$country->id] = $country->country_name_en;
			}
		}
        return view('admin.malls.create', ['title'=> trans("add"), 'countries' => $select_country]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_ar'              => 'required|min:3|max:50',
            'name_en'    		   => 'required|min:3|max:50',
            'email'                => 'required|email',
            'mobile'               => 'required|regex:/(01)[0-9]{9}/',
            'address'              => 'sometimes|nullable|string',
            'facebook'             => 'sometimes|nullable|url',
            'twitter'              => 'sometimes|nullable|url',
            'website'              => 'sometimes|nullable|url',
            'contact_name'         => 'sometimes|nullable|string',
            'lat'                  => 'sometimes|nullable',
            'long'                 => 'sometimes|nullable',
            'icon'                 => 'required|max:10000|'.validate_image(),
            'country_id'           => 'required|numeric',
        ]);
        if($validatedData){
            if($request->hasFile('icon')){
                $validatedData['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'malls',
                    'upload_type' => 'single',
                    'delete_file' => '',
                ]);
            }
            $validatedData['status'] = 1;
            Mall::create($validatedData);
            session()->flash('success', __('admin.record_added_successfully'));
            return redirect(adminURL('admin/malls'));
        }
    }

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
    	$countries = Country::select('*')->whereNotIn('status', [-1])->get();
    	$select_country = [];
		foreach($countries as $country){
			if(session('lang') == 'ar'){
				$select_country[$country->id] = $country->country_name_ar;
			}else{
				$select_country[$country->id] = $country->country_name_en;
			}
		}

        $mall = Mall::find($id);
        $country_id = $mall->country->id;
        $title = __('edit');
        return view('admin.malls.edit', ['mall' => $mall, 'title' => $title, 'countries' =>$select_country, 'country_id' => $country_id]);
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
            'name_ar'              => 'required|min:3|max:50',
            'name_en'              => 'required|min:3|max:50',
            'facebook'             => 'sometimes|nullable|url',
            'twitter'              => 'sometimes|nullable|url',
            'website'              => 'sometimes|nullable|url',
            'contact_name'         => 'sometimes|nullable|string',
            'lat'                  => 'sometimes|nullable',
            'long'                 => 'sometimes|nullable',
            'icon'                 => 'max:10000|'.validate_image(),
            'country_id'       => 'required|numeric',
        ]);

        if($validatedData){

            $mall = Mall::find($id);
            if($request->hasFile('icon')){
                $validatedData['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'malls',
                    'upload_type' => 'single',
                    'delete_file' => $mall->icon,
                ]);
            }
            Mall::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/malls'));
        }
    }

    /**
    * Remove the specified resourse from storage.
    */
    public function delete_mall($id){
        $mall = Mall::find($id);
        Storage::delete($mall->icon);
        $mall->status = -1;
        $mall->icon = null;
        $mall->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        self::delete_mall($id);
        session()->flash('success', __('admin.delete_successfully'));
        return back();
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $mallsIDs = $request->item;
        foreach ($mallsIDs as $key => $mallId) {
            self::delete_mall($mallId);
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
