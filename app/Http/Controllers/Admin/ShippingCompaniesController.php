<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ShippingCompaniesDatatable;
use App\ShippingCompany;
use App\User;
use Storage;

class ShippingCompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingCompaniesDatatable $shippingCompany)
    {
        /*
            data in datatable comes from ShippingCompaniesDataTable query method
            not this method
        */

        //$data = User::latest()->get();
        $data = ShippingCompany::select('*')->whereNotIn('status', [-1])->get();
        return $shippingCompany->render('admin.shippingCompanies.index', ['title' => __('admin.shippingCompaniesController')]);
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
        $companies = User::select('*')->where('level', 'company')
                                      ->whereNotIn('status', [-1])->get();

        $companies_select = [];
        
        foreach($companies as $company){
            $companies_select[$company->id] = $company->name;
        }

        return view('admin.shippingCompanies.create', ['title'=> trans("admin.add"), 'companies' => $companies_select]);
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
            'name_ar'              => 'required|min:3|max:50',
            'name_en'    		   => 'required|min:3|max:50',
            'user_id'              => 'required|numeric',
            'lat'                  => 'sometimes|nullable',
            'long'                 => 'sometimes|nullable',
            'icon'                 => 'required|max:10000|'.validate_image(),
        ]);
        //return $request;
        if($validatedData){
            if($request->hasFile('icon')){
                $validatedData['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'shippingCompanies',
                    'upload_type' => 'single',
                    'delete_file' => '',
                ]);
            }
            $validatedData['status'] = 1;
            ShippingCompany::create($validatedData);
            session()->flash('success', __('admin.record_added_successfully'));
            return redirect(adminURL('admin/shippingCompanies'));
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
        $shippingCompany = ShippingCompany::find($id);
        $companies = User::select('*')->where('level', 'company')
                                      ->whereNotIn('status', [-1])->get();

        $companies_select = [];
        
        foreach($companies as $company){
            $companies_select[$company->id] = $company->name;
        }
        $title = __('admin.edit');
        return view('admin.shippingCompanies.edit', ['shippingCompany' => $shippingCompany,
                    'companies' => $companies_select, 'title' => $title]);
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
            'name_ar'              => 'required|min:3|max:50',
            'name_en'              => 'required|min:3|max:50',
            'lat'                  => 'sometimes|nullable',
            'long'                 => 'sometimes|nullable',
            'icon'                 => 'max:10000|'.validate_image(),
        ]);

        if($validatedData){

            $shippingCompany = ShippingCompany::find($id);
            if($request->hasFile('icon')){
                $validatedData['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'shippingCompanies',
                    'upload_type' => 'single',
                    'delete_file' => $shippingCompany->icon,
                ]);
            }
            ShippingCompany::where('id', $id)->update($validatedData);
            session()->flash('success', __('admin.updated_successfully'));
            return redirect(adminURL('admin/shippingCompanies'));
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
        $shippingCompany = ShippingCompany::find($id);
        Storage::delete($shippingCompany->icon);
        $shippingCompany->status = -1;
        $shippingCompany->icon = null;
        $shippingCompany->save();

        
        session()->flash('success', __('admin.delete_successfully'));
        return back();
    }

    /**
     * Remove the selected resource/ resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(Request $request){
        $shippingCompaniesIDs = $request->item;
        foreach ($shippingCompaniesIDs as $key => $shippingCompanyID) {
            $shippingCompany = ShippingCompany::find($shippingCompanyID);
            Storage::delete($shippingCompany->icon);
            $shippingCompany->status = -1;
            $shippingCompany->icon = null;
            $shippingCompany->save();
            
        }
        session()->flash('seccess', __('admin.delete_successfully'));
        return back();
    }
}
