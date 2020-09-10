<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use App\DataTables\CountriesDataTable;
use Storage;
// use Upload;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountriesDataTable $country)
    {
        /*
            data in datatable comes from CountriesDatatable query method
            not this method
        */

        //$data = User::latest()->get();
        $data = Country::select('*')->whereNotIn('status', [-1])->get();
        return $country->render('admin.countries.index', ['title' => __('admin.countriesController')]);
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
        return view('admin.countries.create', ['title'=> trans("admin.add")]);
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
            'country_name_ar'     => 'required|min:3|max:50',
            'country_name_en'     => 'required|min:3|max:50',
            'country_code'        => 'required',
            'country_iso_code'    => 'required',
            'country_currency'    => 'required',
            'country_flag'        => 'required|max:10000|'.validate_image(),
        ]);
        //return $request;
        if($validatedData){
            if($request->hasFile('country_flag')){
                $validatedData['country_flag'] = up()->upload([
                    'file'        => 'country_flag',
                    'path'        => 'countries_flags',
                    'upload_type' => 'single',
                    'delete_file' => '',
                ]);
            }
            $validatedData['status'] = 1;
            Country::create($validatedData);
            session()->flash('success', __('admin.record_added_successfully'));
            return redirect(adminURL('admin/countries'));
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
        $country = Country::find($id);
        $title = __('admin.edit');
        return view('admin.countries.edit', compact('country', 'title'));
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
            'country_name_ar'     => 'required|min:3|max:50',
            'country_name_en'     => 'required|min:3|max:50',
            'country_code'        => 'required',
            'country_iso_code'    => 'required',
            'country_currency'    => 'required',
            'country_flag'        => 'max:10000|'.validate_image(),
        ]);

        if($validatedData){

            $country = Country::find($id);
            if($request->hasFile('country_flag')){
                $validatedData['country_flag'] = up()->upload([
                    'file'        => 'country_flag',
                    'path'        => 'countries_flags',
                    'upload_type' => 'single',
                    'delete_file' => $country->country_flag,
                ]);
            }
            Country::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/countries'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
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
