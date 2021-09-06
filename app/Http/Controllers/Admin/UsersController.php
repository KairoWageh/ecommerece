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
        $attributes = [
            'name'                  => $request->name,
            'email'                 => $request->email,
            'level'                 => $request->level,
            'password'              => $request->password

        ];
        $user = $this->user->store($attributes, $this->model);
        if($user == true){
            $data = [
                'user'  => $user,
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
        $attributes = [
            'edit_name'         => $request->edit_name,
            'edit_email'        => $request->edit_email,
            'password'          => $request->edit_password,

        ];
        $user = $this->user->update($attributes, $this->model, $id);
        if($user == true){
            $data = [
                'user'  => $user,
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
        session()->flash('seccess', __('delete_successfully'));
        return back();
    }
}
