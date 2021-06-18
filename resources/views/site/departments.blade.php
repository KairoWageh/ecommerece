@extends('site.index')

@section('content')
<div class="container">
    @foreach($departments as $department)
    	<div class="col-md-4">
            <div class="product-f-image" style="height: 50%; width: 50%">
                <img src="{{ Storage::url($department->icon) }}" alt="department_icon">
            </div>
            @if(app()->getLocale() == 'ar')
            	<h4><a href="departments/{{$department->department_name_ar}}" style="text-decoration: none;"> {{$department->department_name_ar}}</a></h4>
            @else
            	<h4><a href="departments/{{$department->department_name_en}}" style="text-decoration: none;"> {{$department->department_name_en}}</a></h4>
            @endif                               
        </div>
    	<div class="clear-fix"></div>
    @endforeach
</div>
@endsection