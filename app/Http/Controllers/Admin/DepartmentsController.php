<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use App\DataTables\DepartmentsDatatable;
use Storage;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DepartmentsDatatable $department)
    {
        /*
            data in datatable comes from StatesDatatable query method
            not this method
        */

        //$data = User::latest()->get();
        $data = Department::select('*')->whereNotIn('status', [-1])->get();
        return $department->render('admin.departments.index', ['title' => __('admin.departmentsController')]);
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
		
        return view('admin.departments.create', ['title'=> trans("admin.add")]);
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
            'department_name_ar'                   => 'required|min:3|max:50',
            'department_name_en'                   => 'required|min:3|max:50',
            'icon'                                 => 'sometimes|nullable|'.validate_image(),   
            'department_description_ar'            => 'sometimes|nullable', 
            'department_description_en'            => 'sometimes|nullable', 
            'keywords'                             => 'sometimes|nullable',  
            'parent_id'                            => 'sometimes|nullable|numeric',
        ]);
        //return $request;
        if($validatedData){
            if($request->hasFile('icon')){
                $validatedData['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'departments',
                    'upload_type' => 'single',
                    'delete_file' => '',
                ]);
            }
            $validatedData['status'] = 1;
            Department::create($validatedData);
            session()->flash('success', __('admin.record_added_successfully'));
            return redirect(adminURL('admin/departments'));
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
        $department = Department::find($id);

        $title = __('admin.edit');
        //return $country_id;
        return view('admin.departments.edit', 
                    ['department' => $department, 'title' => $title]);
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
            'department_name_ar'                   => 'required|min:3|max:50',
            'department_name_en'                   => 'required|min:3|max:50',
            'icon'                                 => 'sometimes|nullable',   
            'department_description_ar'            => 'sometimes|nullable', 
            'department_description_en'            => 'sometimes|nullable', 
            'keywords'                             => 'sometimes|nullable',  
            'parent_id'                            => 'sometimes|nullable|numeric',
        ]);

        if($validatedData){
            if($request->hasFile('icon')){
                $validatedData['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'departments',
                    'upload_type' => 'single',
                    'delete_file' => Department::find($id)->icon,
                ]);
            }
            $department = Department::find($id);
            Department::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/departments'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public static function delete_parent($id){
        // get sub departments of parent department using its id
        $department_parent = Department::where('parent_id', $id)->get();
        // loop sub departments
        foreach ($department_parent as $sub) {
            //echo $sub->status;
            self::delete_parent($sub->id);
            // if sub department has an icon, delete it
            if(!empty($sub->icon)){
                Storage::has($sub->icon)?Storage::delete($sub->icon):'';
                $sub->icon = null;
            }
            // change status of sub department 
            $sub_department = Department::find($sub->id);
            if(!empty($sub_department)){
                $sub_department->status = -1;
                $sub_department->icon = null;
                $sub_department->save();
            }
        }
        // get parent department using its id
        $department = Department::find($id);
        // if parent department has an icon, delete it
        if(!empty($department->icon)){
            Storage::has($department->icon)?Storage::delete($department->icon):'';
            $sub->icon = null;
        }
        // change status of parent department
        $department->status = -1;
        $department->icon;
        $department->save();
    }

    public function destroy($id)
    {
        self::delete_parent($id);
        session()->flash('success', __('admin.delete_successfully'));
        return back();
    }
}
