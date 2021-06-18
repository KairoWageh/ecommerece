<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Plan;

class PlanController extends Controller
{
	public function index()
	{
        $plans = Plan::all();
        return view('site.plans.index', compact('plans'));
	}

	public function show(Plan $plan, Request $request)
	{
	     return view('site.plans.show', compact('plan'));
	}
}
