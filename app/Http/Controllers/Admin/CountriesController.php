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
     * @return mixed
     */
    public function countries_count(){
        return $this->country->get_count($this->model);
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
        $attributes = [
            'country_name_ar'   => $request->country_name_ar,
            'country_name_en'   => $request->country_name_en,
            'country_code'      => $request->country_code,
            'country_iso_code'  => $request->country_iso_code,
            'country_currency'  => $request->country_currency,
            'country_flag'      => $request->country_flag
        ];
        $country = $this->country->store($attributes, $this->model);
        if($country == true){
            $data = [
                'country'  => $country,
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
        return $this->country->find($this->model, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        $attributes = [
            'country_name_ar'   => $request->edit_country_name_ar,
            'country_name_en'   => $request->edit_country_name_en,
            'country_code'      => $request->edit_country_code,
            'country_iso_code'  => $request->edit_country_iso_code,
            'country_currency'  => $request->edit_country_currency,
            'country_flag'      => $request->edit_country_flag

        ];
        $country = $this->country->update($attributes, $this->model, $id);
        if($country == true){
            $data = [
                'country'  => $country,
                'toast'    => 'success',
                'message'  => __('updated')
            ] ;
        }else{
            $data = [
                'toast'    => 'error',
                'message'  => __('not_updated')
            ] ;
        }
        return $data;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = $this->country->delete($this->model, $id);
        $deleted = $country->delete();
        if($deleted == 1){
            $data = [
                'toast'    => 'success',
                'message'  => __('deleted')
            ] ;
        }else{
            $data = [
                'toast'    => 'error',
                'message'  => __('not_deleted')
            ] ;
        }
        return $data;
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $countriesIDs = $request->item;
        foreach ($countriesIDs as $key => $countryID) {
            self::destroy($countryID);
        }
        session()->flash('seccess', __('delete_successfully'));
        return back();
    }
}
