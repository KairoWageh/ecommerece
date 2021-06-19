<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Color;
use App\DataTables\ColorsDataTable;
use Storage;
// use Upload;

class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ColorsDataTable $color)
    {
        /*
            data in datatable comes from ColorsDatatable query method
            not this method
        */
        $data = Color::select('*')->whereNotIn('status', [-1])->get();
        return $color->render('admin.colors.index', ['title' => __('colorsController')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create', ['title'=> trans("add")]);
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
            'color'       => 'required|string',
        ]);
        if($validatedData){
            $validatedData['status'] = 1;
            Color::create($validatedData);
            session()->flash('success', __('admin.record_added_successfully'));
            return redirect(adminURL('admin/colors'));
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
        $color = Color::find($id);
        $title = __('edit');
        return view('admin.colors.edit', compact('color', 'title'));
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
            'color'       => 'required|string',
        ]);
        if($validatedData){
            Color::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/colors'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */

    public function delete_color($id){
        $color = Color::find($id);
        $color->status = -1;
        $color->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        self::delete_color($id);
        session()->flash('success', __('admin.delete_successfully'));
        return back();
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $colorsIDs = $request->item;
        foreach ($colorsIDs as $key => $colorId) {
            self::delete_color($colorId);
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
