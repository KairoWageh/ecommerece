<?php

namespace App\Http\Controllers\Admin;

use App\Repository\contracts\AdminRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDatatable;
use App\Admin;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    protected $admin;
    protected $model;

    /**
     * AdminController constructor.
     * @param AdminRepositoryInterface $adminRepository
     * @param Admin $adminModel
     */
    public function __construct(AdminRepositoryInterface $adminRepository, Admin $adminModel){
        $this->admin = $adminRepository;
        $this->model = $adminModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @param AdminDatatable $admin
     * @return Response
     */
    public function index(AdminDatatable $admin)
    {
        /**
         * data in datatable comes from AdminDatatable query method not this method
         */
        $this->admin->all($this->model);
        return $admin->render('admin.admins', ['title' => __('adminController')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|min:3|max:50',
            'email'    => 'required|email|unique:admins',
            'password' => 'required'
        ]);
        if($validatedData == true){
            return $this->admin->store($request, $this->model);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return $this->admin->find($this->model, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'edit_name'     => 'required|min:3|max:50',
            'edit_email'    => 'required|email|unique:admins,email,'.$id,
        ]);

        if($validatedData){
            return $this->admin->update($request, $this->model, $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        return $this->admin->delete($this->model, $id);
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function multi_delete(Request $request){
        $adminsIDs = $request->item;
        foreach ($adminsIDs as $key => $adminID) {
            self::destroy($adminID);
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
