<?php

namespace App\Http\Controllers\Admin;

use App\Repository\contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\UsersDatatable;
use App\User;

class UsersController extends Controller
{
    protected $user;
    protected $model;

    /**
     * UsersController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param User $userModel
     */
    public function __construct(UserRepositoryInterface $userRepository, User $userModel)
    {
        $this->user = $userRepository;
        $this->model = $userModel;
    }

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
        $data = $this->user->all($this->model);
        $user_levels = ["user" => __('user'), "company" => __('company'), "vendor" => __('vendor')];
        return $user->render('admin.users', ['title' => __('usersController'), 'user_levels' => $user_levels]);
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
            return $this->user->store($request, $this->model);
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
        return $this->user->find($this->model, $id);

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
            'edit_email'    => 'required|email|unique:users,email,'.$id,
//            'password' => 'required',
//            'level'    => 'required|in:user,company,vendor'
        ]);

        if($validatedData){
            return $this->user->update($request, $this->model, $id);
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
        return $this->user->delete($this->model, $id);
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $usersIDs = $request->item;
        foreach ($usersIDs as $key => $userID) {
            self::destroy($userID);
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
