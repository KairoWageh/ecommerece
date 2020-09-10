<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\UsersDatatable;
use DataTables;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDatatable $user)
    {
        /*
            data in datatable comes from UsersDatatable query method
            not this method
        */

        //$data = User::latest()->get();
        $data = User::select('*')->whereNotIn('status', [-1])->get();
        return $user->render('admin.users.index', ['title' => __('admin.usersController')]);
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
        $user_levels = ["user" => __('admin.user'), "company" => __('admin.company'), "vendor" => __('admin.vendor')];
        return view('admin.users.create', ['title'=> trans("admin.add"), 'user_levels' => $user_levels]);
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
            'email'    => 'required|email|unique:users',
            'level'    => 'required|in:user,company,vendor',
            'password' => 'required'
        ]);
        if($validatedData){
            $request->password = bcrypt($request->password);
            User::create([
                'name'     => $request['name'],
                'email'    => $request['email'],
                'password' => $request->password,
                'level'    => $request['level'],
                'status'   => 1
            ]);
            session()->flash('success', __('admin.record_added_successfully'));
            return redirect(adminURL('admin/users'));
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
        $user = User::find($id);
        $title = __('admin.edit');
        $user_levels = ["user" => __('admin.user'), "company" => __('admin.company'), "vendor" => __('admin.vendor')];
        return view('admin.users.edit', compact('user', 'title', 'user_levels'));
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
            'email'    => 'required|email|unique:users,email,'.$id,
            'password' => 'required',
            'level'    => 'required|in:user,company,vendor'
        ]);

        if($validatedData){
            $user = User::find($id);
            //return gettype($validatedData);
            $validatedData['password'] = bcrypt($request->password);
            User::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/users'));
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
        $user = User::find($id);
        $user->status = -1;
        $user->save();
        session()->flash('success', __('admin.delete_successfully'));
        return back();
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $usersIDs = $request->item;
        foreach ($usersIDs as $key => $userID) {
            $user = User::find($userID);
            $user->status = -1;
            $user->save();
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
