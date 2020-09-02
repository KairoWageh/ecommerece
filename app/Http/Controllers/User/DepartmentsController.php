<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;

class DepartmentsController extends Controller
{
    public function index()
    {
        $departments = Department::select('*')->whereNotIn('status', [-1])->get();
        return view('site.departments', compact('departments'));
    }
}
