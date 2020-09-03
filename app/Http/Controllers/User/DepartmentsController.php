<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Product;

class DepartmentsController extends Controller
{
    public function index()
    {
        $departments = Department::select('*')->whereNotIn('status', [-1])->get();
        return view('site.departments', compact('departments'));
    }

    public function single_dep($dep_name){
    	$department = Department::where('department_name_ar', $dep_name)->orWhere('department_name_en', $dep_name)->get();
    	$department_id = $department[0]->id;
    	$products = Product::select('*')->where('department_id', $department_id)->whereNotIn('status', [-1])->get();
    	return view('site.single_dep', compact('products'));
    }
}
