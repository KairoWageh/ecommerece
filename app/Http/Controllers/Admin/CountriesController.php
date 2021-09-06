<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\contracts\CountryRepositoryInterface;
use Illuminate\Http\Request;
use App\Country;
use App\DataTables\CountriesDataTable;
use Storage;
// use Upload;

class CountriesController extends Controller
{
    protected $country;
    protected $model;

    public function __construct(CountryRepositoryInterface $countryRepository, Country $countryModel)
    {
        $this->country = $countryRepository;
        $this->model = $countryModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountriesDataTable $country)
    {
        /**
         * data in datatable comes from CountriesDatatable query method not this method
         */

        $this->country->all($this->model);
        return $country->render('admin.countries', ['title' => __('countriesController')]);
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
     * @param $id
     * @return mixed
     */
    public function get_country_cities($id)
    {
        return $this->country->get_country_cities($this->model, $id);
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
        $title = __('edit');
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

    // Remove the specified country and its cities and states from storage.

    public function delete_country($id){
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        self::delete_country($id);
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
            self::delete_country($countryID);
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
