<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Weight;
use App\DataTables\WeightsDataTable;
use Storage;
// use Upload;

class WeightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WeightsDataTable $weight)
    {
        /*
            data in datatable comes from ColorsDatatable query method
            not this method
        */

        $data = Weight::select('*')->whereNotIn('status', [-1])->get();
        return $weight->render('admin.weights', ['title' => __('weightsController')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weights.create', ['title'=> trans("add")]);
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
            'name_ar'     => 'required',
            'name_en'     => 'required',
        ]);
        if($validatedData){
            $validatedData['status'] = 1;
            Weight::create($validatedData);
            session()->flash('success', __('admin.record_added_successfully'));
            return redirect(adminURL('admin/weights'));
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
        $weight = Weight::find($id);
        $title = __('edit');
        return view('admin.weights.edit', compact('weight', 'title'));
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
            'name_ar'     => 'required',
            'name_en'     => 'required',
        ]);

        if($validatedData){
            Weight::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/weights'));
        }
    }

    /**
    * Remove the specified resourse from storage.
    */
    public function delete_weight($id){
        $weight = Weight::find($id);
        $weight->status = -1;
        $weight->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        self::delete_weight($id);
        session()->flash('success', __('admin.delete_successfully'));
        return back();
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $weightsIDs = $request->item;
        foreach ($weightsIDs as $key => $weightId) {
            self::delete_weight($weightId);
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
