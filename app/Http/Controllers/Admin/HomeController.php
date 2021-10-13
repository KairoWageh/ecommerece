<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\View\View;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * shows home page for admin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function home(){
    	$registeredUsers     = User::where('level', 'user')->count();
        $registeredVendors   = User::where('level', 'vendor')->count();
        $registeredCompanies = User::where('level', 'company')->count();
        $latest_users = User::latest()->take(8)->get();
        $latest_users_c = collect();;
        foreach ($latest_users as $user){
            $joined_at = '';
            if(Carbon::parse($user->created_at)->isToday() == true) {
                $joined_at == __('today');
            }elseif (Carbon::parse($user->created_at)->isYesterday() == true) {
                $joined_at == __('yesterday');
            }else {
                $joined_at = Carbon::parse($user->created_at)->format('d M Y');
            }
            $user->joined_at = $joined_at;
            $latest_users_c->add($user);
        }


    	return view('admin.home', compact('registeredUsers', 'registeredVendors', 'registeredCompanies', 'latest_users_c'));
    }
}
