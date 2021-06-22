<?php

namespace App\Http\Controllers\Admin;

use App\Repository\contracts\AdminRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDatatable;
use DataTables;
use App\Admin;

class AdminController extends Controller
{
    protected $admin;
    protected $model;

    /**
     * AdminController constructor.
     * @param AdminRepositoryInterface $admin
     */
    public function __construct(AdminRepositoryInterface $adminRepository, Admin $adminModel){
        $this->admin = $adminRepository;
        $this->model = $adminModel;
    }
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
        $this->admin->all($this->model);
        return $admin->render('admin.admins', ['title' => __('adminController')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        if($validatedData == true){;
            return $this->admin->store($request, $this->model);
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
        $admin = $this->admin->find($this->model, $id);
        return $admin;
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
            'edit_name'     => 'required|min:3|max:50',
            'edit_email'    => 'required|email|unique:admins,email,'.$id,
        ]);

        if($validatedData){
            $update_admin_data = [
                'name' => $request->edit_name,
                'email' => $request->edit_email
            ];
            $updated = Admin::where('id', $id)->update($update_admin_data);
            if($updated == 1){
                $admin = $this->admin->find($this->model, $id);
                $data = [
                    'admin'  => $admin,
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = $this->admin->find($this->model, $id);
        if($admin){
            $admin->delete();
            $data = [
                'toast'    => 'success',
                'message' => __('deleted')
            ];
        }else{
            $data = [
                'toast'    => 'error',
                'message' => __('admin.not_deleted')
            ];
        }
        return $data;
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
