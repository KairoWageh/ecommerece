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
        $validatedData = $request->validate([
            'edit_city_name_ar'     => 'required|min:3|max:50',
            'edit_city_name_en'     => 'required|min:3|max:50',
            'edit_country_id'       => 'required|numeric',
        ]);
        if($validatedData){
            return $this->city->update($request, $this->model, $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->city->delete($this->model, $id);
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $citiesIDs = $request->item;
        foreach ($citiesIDs as $key => $cityID) {
            self::destroy($cityID);
        }
//        session()->flash('seccess', __('admin.delete_successfully'));
//        return back();
    }


}
