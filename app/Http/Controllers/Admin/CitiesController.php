<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\contracts\CityRepositoryInterface;
use Illuminate\Http\Request;
use App\City;
use App\Country;
use App\DataTables\CitiesDataTable;

class CitiesController extends Controller
{
    protected $city;
    protected $model;

    /**
     * CitiesController constructor.
     * @param CityRepositoryInterface $cityRepository
     * @param City $cityModel
     */
    public function __construct(CityRepositoryInterface $cityRepository, City $cityModel)
    {
        $this->city = $cityRepository;
        $this->model = $cityModel;
    }

    /**
     * @return mixed
     */
    public function cities_count(){
        return $this->city->get_count($this->model);
    }

    /**
     * Display a listing of the resource.
     * @param CitiesDataTable $city
     * @return mixed
     */
    public function index(CitiesDataTable $city)
    {
        /*
            data in datatable comes from CitiesDatatable query method
            not this method
        */
        $countries = Country::select('*')->get();
        $select = [];
        foreach($countries as $country) {
            if (session('lang') == 'ar') {
                $select[$country->id] = $country->country_name_ar;
            } else {
                $select[$country->id] = $country->country_name_en;
            }
        }
        $this->city->allCities($this->model);
        return $city->render('admin.cities', ['title' => __('citiesController'), 'countries' => $select]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $attributes = [
            'city_name_ar'   => $request->city_name_ar,
            'city_name_en'   => $request->city_name_en,
            'country_id'     => $request->country_id,
        ];
        $city = $this->city->store($attributes, $this->model);
        if($city == true){
            $data = [
                'city'  => $city,
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


        $validatedData = $request->validate([
            'city_name_ar'     => 'required|min:3|max:50',
            'city_name_en'     => 'required|min:3|max:50',
            'country_id'       => 'required|numeric',
        ]);
        if($validatedData == true){
            return $this->city->store($request, $this->model);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->city->find($this->model, $id);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $attributes = [
            'city_name_ar'   => $request->edit_city_name_ar,
            'city_name_en'   => $request->edit_city_name_en,
            'country_id'      => $request->edit_country_id,
        ];
        $city = $this->city->update($attributes, $this->model, $id);
        if($city == true){
            $data = [
                'city'  => $city,
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
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $deleted = $this->city->delete($this->model, $id);
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function multi_delete(Request $request){
        $citiesIDs = $request->item;
        foreach ($citiesIDs as $key => $cityID) {
            self::destroy($cityID);
        }
        session()->flash('seccess', __('delete_successfully'));
        return back();
    }


}
