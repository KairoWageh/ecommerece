<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDatatable;
use DataTables;
use App\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDatatable $admin)
    {
        /*
            data in datatable comes from AdminDatatable query method
            not this method
        */

        //$data = Admin::latest()->get();
        $data = Admin::select('*')->whereNotIn('status', [-1])->get();
        return $admin->render('admin.admins.index', ['title' => __('adminController')]);
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
        return view('admin.admins.create', ['title'=> trans("addNewAdmin")]);
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
            'name'     => 'required|min:3|max:50',
            'email'    => 'required|email|unique:admins',
            'password' => 'required'
        ]);
        if($validatedData){
            self::adminCreate($request);
            session()->flash('success', __('admin.record_added_successfully'));
            return redirect(adminURL('admin/admin'));
        }
    }

    public function adminCreate($request){
        $request->password = bcrypt($request->password);
        Admin::create([
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => $request->password,
            'status'   => 1
        ]);
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
        $admin = Admin::find($id);
        $title = __('editAdmin');
        return view('admin.admins.edit', compact('admin', 'title'));
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
            'name'     => 'required|min:3|max:50',
            'email'    => 'required|email|unique:admins,email,'.$id,
            'password' => 'required'
        ]);

        if($validatedData){
            $admin = Admin::find($id);
            $validatedData['password'] = bcrypt($request->password);
            Admin::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/admin'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */

    public function delete_admin($id){
        $admin = Admin::find($id);
        $admin->status = -1;
        $admin->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        self::delete_admin($id);
        session()->flash('success', __('admin.delete_successfully'));
        return back();
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $adminsIDs = $request->item;
        foreach ($adminsIDs as $key => $adminID) {
            self::delete_admin($adminID);
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
