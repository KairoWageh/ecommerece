<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\Country;
use App\DataTables\CitiesDataTable;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CitiesDataTable $city)
    {
        /*
            data in datatable comes from CitiesDatatable query method
            not this method
        */

        //$data = User::latest()->get();
        $data = City::select('*')->whereNotIn('status', [-1])->get();
        return $city->render('admin.cities.index', ['title' => 'Cities Controller']);
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
    	$countries = Country::select('*')->whereNotIn('status', [-1])->get();
    	$select = [];
		foreach($countries as $country){
			if(session('lang') == 'ar'){
				$select[$country->id] = $country->country_name_ar;
			}else{
				$select[$country->id] = $country->country_name_en;
			}
		}
        return view('admin.cities.create', ['title'=> trans("admin.add"), 'countries' => $select]);
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
            'city_name_ar'     => 'required|min:3|max:50',
            'city_name_en'     => 'required|min:3|max:50',
            'country_id'       => 'required|numeric',         
        ]);
        //return $request;
        if($validatedData){
            $validatedData['status'] = 1;
            City::create($validatedData);
            session()->flash('success', __('admin.record_added_successfully'));
            return redirect(adminURL('admin/cities'));
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
    	$select = [];
		foreach($countries as $country){
			if(session('lang') == 'ar'){
				$select[$country->id] = $country->country_name_ar;
			}else{
				$select[$country->id] = $country->country_name_en;
			}
		}

        $city = City::find($id);
        $country_id = $city->country->id;
        $title = __('admin.edit');
        //return $country_id;
        return view('admin.cities.edit', ['city' => $city, 'title' => $title, 'countries' =>$select, 'country_id' => $country_id]);
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
            'city_name_ar'     => 'required|min:3|max:50',
            'city_name_en'     => 'required|min:3|max:50',
            'country_id'       => 'required|numeric',
        ]);

        if($validatedData){

            $city = City::find($id);
            City::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/cities'));
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
        $city = City::find($id);
        $city->status = -1;
        $city->save();
        $states = $city->states;
        
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
        $citiesIDs = $request->item;
        foreach ($citiesIDs as $key => $cityID) {
            $city = City::find($cityID);
            $city->status = -1;
            $city->save();
            $states = $city->states;
        
            foreach ($states as $state) {
                $state->status = -1;
                $state->save();
            }
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
