<?php

namespace App\Http\Controllers\Admin;

use App\Repository\contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\UsersDatatable;
use DataTables;
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
//        $data = User::select('*')->whereNotIn('status', [-1])->get();
        $data = $this->user->all($this->model);
        $user_levels = ["user" => __('user'), "company" => __('company'), "vendor" => __('vendor')];
        return $user->render('admin.users', ['title' => __('usersController'), 'user_levels' => $user_levels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_levels = ["user" => __('user'), "company" => __('company'), "vendor" => __('vendor')];
        return view('admin.users.create', ['title'=> trans("add"), 'user_levels' => $user_levels]);
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
        $user = $this->user->find($this->model, $id);
        return $user;
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
//            $validatedData['password'] = bcrypt($request->password);
            $update_user_data = [
                'name' => $request->edit_name,
                'email' => $request->edit_email
            ];
            $updated = User::where('id', $id)->update($update_user_data);
            if($updated == 1){
                $updated_user = $this->user->find($this->model, $id);
                $data = [
                    'user'  => $updated_user,
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
    * Remove the specified resourse from storage.
    */
    public function delete_user($id){
        $user = User::find($id);
        $user->status = -1;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($this->model, $id);
        if($user){
            $user->delete();
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
        $usersIDs = $request->item;
        foreach ($usersIDs as $key => $userID) {
            self::delete_user($userID);
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
