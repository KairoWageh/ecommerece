<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Facades\Storage;
// use Upload;

class SettingsController extends Controller
{
    /**
    * return view of settings page
    */
    public function settings(){
    	return view('admin.settings', ['title' => __('admin.settings')]);
    }

    /**
    * validate settings information after submition,
    * and save it
    */
    public function settings_save(Request $request){
    	$validateData = $request->validate([
    		'sitename_ar' 			 => 'required|min:3|max:50',
    		'sitename_en' 			 => 'required|min:3|max:50',
    		'email'       			 => 'required|email',
    		'logo'        			 => 'max:10000|'.validate_image(),
    		'icon'        			 => 'max:10000|'.validate_image(),      
            'main_lang'              => 'required',
    		'description_ar' 	     => 'required|min:20|max:500',
            'description_en'         => 'required|min:20|max:500',
    		'keywords'               => 'required|min:20|max:500',
            'status'                 => 'required',
    		'message_maintenance'    => 'required|min:20|max:500',
    	]);
        if($validateData){
            if($request->hasFile('logo')){
                // if(!empty(setting()->logo)){
                //     Storage::delete(setting()->logo);
                // }
                // $validateData['logo'] = $request->file('logo')->store('settings');
                $validateData['logo'] = up()->upload([
                    'file'        => 'logo',
                    'path'        => 'settings',
                    'upload_type' => 'single',
                    'delete_file' => setting()->logo,
                ]);
            }
            if($request->hasFile('icon')){
                // if(!empty(setting()->icon)){
                //    Storage::delete(settings()->icon); 
                // }
                // $validateData['icon'] = $request->file('icon')->store('settings');
                $validateData['icon'] = up()->upload([
                    'file'        => 'icon',
                    'path'        => 'settings',
                    'upload_type' => 'single',
                    'delete_file' =>  setting()->icon
                ]);
            }
            $settings = Setting::orderBy('id', 'desc')->update($validateData);
            session()->flash('success', __('admin.updated_successfully'));
            return back();
        }
    } 
}
