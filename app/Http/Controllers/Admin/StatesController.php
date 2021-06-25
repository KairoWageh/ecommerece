<?php

namespace App\Http\Controllers\Admin;

use App\Repository\contracts\StateRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use App\City;
use App\State;
use App\DataTables\StatesDataTable;

class StatesController extends Controller
{
    protected $state;
    protected $model;

    public function __construct(StateRepositoryInterface $stateRepository, State $stateModel)
    {
        $this->state = $stateRepository;
        $this->model = $stateModel;
    }

    /**
     * Display a listing of the resource.
     * @param StatesDataTable $state
     * @return mixed
     */
    public function index(StatesDataTable $state)
    {
        /**
         * data in datatable comes from StatesDatatable query method not this method
         */
        $data = State::select('*')->get();
        $lang = app()->getLocale();
        $name = 'country_name_'.$lang;
        $countries = Country::select($name)->get();
        return $state->render('admin.states', ['title' => __('statesController'), 'countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(request()->ajax()){
        //     if(request()->has('country_id')){
        //         $select = request()->has('select')?request('select'):'';
        //         $cities = City::select('*')
        //           ->where('country_id', '=', $country_id)
        //           ->whereNotIn('status', [-1])->get();
        //         return Form::select('city_id', $cities, null, ['class' => 'form-control', 'city_id', 'placeholder' => '.........']);
        //     }
        // }
    	$countries = Country::select('*')->whereNotIn('status', [-1])->get();
    	//$cities = $countries->first()->cities;

    	$countries_select = [];
        //$cities_select = [];

		foreach($countries as $country){
			if(session('lang') == 'ar'){
				$countries_select[$country->id] = $country->country_name_ar;
			}else{
				$countries_select[$country->id] = $country->country_name_en;
			}
		}

        // foreach($cities as $city){
        //     if(session('lang') == 'ar'){
        //         $cities_select[$city->id] = $city->city_name_ar;
        //     }else{
        //         $cities_select[$city->id] = $city->city_name_en;
        //     }
        // }

        return view('admin.states.create', ['title'=> trans("add"), 'countries' => $countries_select]);
    }

    /**
     * Get all cities of the selected contry
     * @param int $country_id
    */
    public function get_country_cities($country_id){
        $cities = City::select('*')
                  ->where('country_id', '=', $country_id)
                  ->whereNotIn('status', [-1])->get();
        $cities_select = [];
        foreach($cities as $city){
            if(session('lang') == 'ar'){
                $cities_select[$city->id] = $city->city_name_ar;
            }else{
                $cities_select[$city->id] = $city->city_name_en;
            }
        }
        return $cities_select;
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
            'state_name_ar'     => 'required|min:3|max:50',
            'state_name_en'     => 'required|min:3|max:50',
            'country_id'        => 'required|numeric',
            'city_id'           => 'required|numeric',
        ]);
        if($validatedData){
            return $this->state->store($request, $this->model);
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
        $state = State::find($id);
        $country_id = $state->country->id;
        $city_id = $state->city->id;

    	$countries = Country::select('*')->whereNotIn('status', [-1])->get();
        $cities = City::select('*')
                    ->where('country_id', $country_id)
                    ->whereNotIn('status', [-1])->get();

    	$countries_select = [];
        $cities_select = [];

		foreach($countries as $country){
			if(session('lang') == 'ar'){
				$countries_select[$country->id] = $country->country_name_ar;
			}else{
				$countries_select[$country->id] = $country->country_name_en;
			}
		}

        foreach($cities as $city){
            if(session('lang') == 'ar'){
                $cities_select[$city->id] = $city->city_name_ar;
            }else{
                $cities_select[$city->id] = $city->city_name_en;
            }
        }

        $title = __('edit');
        //return $country_id;
        return view('admin.states.edit',
                    ['state' => $state, 'title' => $title,
                    'country_id' => $country_id,
                    'city_id' => $city_id,
                    'countries' =>$countries_select,
                    'cities' => $cities_select]);
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
            'state_name_ar'     => 'required|min:3|max:50',
            'state_name_en'     => 'required|min:3|max:50',
            'country_id'        => 'required|numeric',
            'city_id'           => 'required|numeric',
        ]);

        if($validatedData){

            $state = State::find($id);
            State::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/states'));
        }
    }

    /**
    * Remove the specified resourse from storage.
    */
    public function delete_state($id){
        $state = State::find($id);
        $state->status = -1;
        $state->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        self::delete_state($id);
        session()->flash('success', __('admin.delete_successfully'));
        return back();
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $statesIDs = $request->item;
        foreach ($statesIDs as $key => $stateID) {
            self::delete_state($stateID);
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
