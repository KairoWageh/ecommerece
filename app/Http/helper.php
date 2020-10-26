<?php
if(!function_exists('setting')){
	function setting(){
		return \App\Setting::orderBy('id', 'desc')->first();
	}
}

if(!function_exists('get_parent')){
	function get_parent($department_id){
		$list_departments = [];
		$department = \App\Department::find($department_id);
		if(null !== $department->parent_id && $department->parent_id > 0){
			array_push($list_departments, $department->parent_id);
			return get_parent($department->parent_id).",".$department_id;
		}else{
			return $department_id;
		}
	}
}

// scan mall for products

if(!function_exists('check_mall')){
	function check_mall($product_id, $mall_id){
		return App\ProductMall::where('product_id', $product_id)->where('mall_id', $mall_id)->count()>0?true:false;
	}
}


if(!function_exists('load_department')){
	function load_department($select = null, $department_hide = null){
		$departments = \App\Department::selectRaw('department_name_'.session('lang').' as text')
		->selectRaw('id as id')
		->selectRaw('parent_id as parent')
		->whereNotIn('status', [-1])
		->get(['text', 'parent', 'id']);
		$departments_array = [];
		foreach ($departments as $department) {
			$list_array             = [];
			$list_array['icon']     = '';
			$list_array['li_attr']  = '';
			$list_array['a_attr']   = '';
			$list_array['children'] = [];
			if($select !== null and $select == $department->id){
				$list_array['state']    = [
					'opened'   => true,
					'selected' => true,
					'disabled' => false,
				];
			}
			if($department_hide !== null and $department_hide == $department->id){
				$list_array['state']    = [
					'opened'   => false,
					'selected' => false,
					'disabled' => true,
					'hidden'   => true,
				];
			}
			$list_array['id'] = $department->id;
			$list_array['parent'] = $department->parent > 0?$department->parent:'#';
			$list_array['text']   = $department->text;
			array_push($departments_array, $list_array);
		}
		return json_encode($departments_array, JSON_UNESCAPED_UNICODE);
	}
}


if(!function_exists('up')){
	function up(){
		return new \App\Http\Controllers\UploadController;
	}
}

if(!function_exists('adminURL')){
	function adminURL($url=null){
		return $url;
	}
}

if(!function_exists('admin')){
	function admin(){
		return auth()->guard('admin');
	}
}

if(!function_exists('user')){
	function user(){
		return auth()->guard('web');
	}
}

if(!function_exists('lang')){
	function lang(){
		if(session()->has('lang')){
			return session('lang');
		}else{
			Session::put('lang', setting()->main_lang);
			//return setting()->main_lang;
			return session('lang');
		}
	}
}

if(!function_exists('direction')){
	function direction(){
		if(session()->has('lang')){
			if(session('lang') == 'ar'){
				return 'rtl';
			}else{
				return 'ltr';
			}
		}else{
			return 'ltr';
		}
	}
}

if(!function_exists('validate_image')){
	function validate_image($extention = null){
		if($extention === null){
			return 'image|mimes:jpg,jpeg,png,gif';
		}else{
			return 'image|mimes:'.$extention;
		}
	}
}
