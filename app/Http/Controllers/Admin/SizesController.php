<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Size;
use App\Department;
use App\DataTables\SizesDataTable;
use Storage;
// use Upload;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SizesDataTable $size)
    {
        /*
            data in datatable comes from ColorsDatatable query method
            not this method
        */

        //$data = User::latest()->get();
        $data = Size::select('*')->whereNotIn('status', [-1])->get();
        return $size->render('admin.sizes.index', ['title' => 'Sizes Controller']);
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
        $departments = Department::select('*')->whereNotIn('status', [-1])->get();
        $select_department = [];
        foreach($departments as $department){
            if(session('lang') == 'ar'){
                $select_department[$department->id] = $department->department_name_ar;
            }else{
                $select_department[$department->id] = $department->department_name_en;
            }
        }
        return view('admin.sizes.create', ['title'=> trans("admin.add"), 'departments' => $select_department]);
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
            'name_ar'         => 'required',
            'name_en'         => 'required',
            'department_id'   => 'required|numeric',
            'is_public'       => 'required|in:yes,no',
        ]);
        //return $request;
        if($validatedData){
            $validatedData['status'] = 1;
            Size::create($validatedData);
            session()->flash('success', __('admin.record_added_successfully'));
            return redirect(adminURL('admin/sizes'));
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
        $size = Size::find($id);
        $title = __('admin.edit');
        return view('admin.sizes.edit', compact('size', 'title'));
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
            'name_ar'         => 'required',
            'name_en'         => 'required',
            'department_id'   => 'required|numeric',
            'is_public'       => 'required|in:yes,no',
        ]);

        if($validatedData){
            Size::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/sizes'));
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
        $size = Size::find($id);
        $size->status = -1;
        $size->save();
        session()->flash('success', __('admin.delete_successfully'));
        return back();
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $sizesIDs = $request->item;
        foreach ($sizesIDs as $key => $sizeId) {
            $size = Size::find($sizeId);
            $size->status = -1;
            $size->save();
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
