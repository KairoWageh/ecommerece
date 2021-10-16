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
        $attributes = [
            'name'                  => $request->name,
            'email'                 => $request->email,
            'password'              => $request->password,
            'password_confirmation'              => $request->password_confirmation

        ];
        $admin = $this->admin->store($attributes, $this->model);
        if($admin == true){
            $data = [
                'admin'  => $admin,
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
     * @return array
     */
    public function update(Request $request, int $id): array
    {
        $attributes = [
            'name'                  => $request->edit_name,
            'email'                 => $request->edit_email,
            'password'              => $request->edit_password,

        ];
        $admin = $this->admin->update($attributes, $this->model, $id);
        if($admin == true){
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id): array
    {
        $admin = $this->admin->delete($this->model, $id);
        $deleted = $admin->delete();
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
