<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ManufacturersDatatable;
use App\Manufacturer;
use Storage;

class ManufacturersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManufacturersDatatable $manufacturer)
    {
        /*
            data in datatable comes from CountriesDatatable query method
            not this method
        */

        $data = Manufacturer::select('*')->whereNotIn('status', [-1])->get();
        return $manufacturer->render('admin.manufacturers', ['title' => __('manufacturesController')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacturers.create', ['title'=> trans("add")]);
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
        ]);
        if($validatedData){
            if($request->hasFile('icon')){
                $validatedData['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'manufacturers',
                    'upload_type' => 'single',
                    'delete_file' => '',
                ]);
            }
            $validatedData['status'] = 1;
            Manufacturer::create($validatedData);
            session()->flash('success', __('admin.record_added_successfully'));
            return redirect(adminURL('admin/manufacturers'));
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
        $manufacturer = Manufacturer::find($id);
        $title = __('edit');
        return view('admin.manufacturers.edit', compact('manufacturer', 'title'));
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
        ]);

        if($validatedData){

            $manufacturer = Manufacturer::find($id);
            if($request->hasFile('icon')){
                $validatedData['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'manufacturers',
                    'upload_type' => 'single',
                    'delete_file' => $manufacturer->icon,
                ]);
            }
            Manufacturer::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/manufacturers'));
        }
    }

    /**
    * Remove the specified resourse from storage.
    */
    public function delete_manufacture($id){
        $manufacturer = Manufacturer::find($id);
        Storage::delete($manufacturer->icon);
        $manufacturer->status = -1;
        $manufacturer->icon = null;
        $manufacturer->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        self::delete_manufacture($id);
        session()->flash('success', __('admin.delete_successfully'));
        return back();
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $manufacturesIDs = $request->item;
        foreach ($manufacturesIDs as $key => $manufactureID) {
            self::delete_manufacture($manufactureID);
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
