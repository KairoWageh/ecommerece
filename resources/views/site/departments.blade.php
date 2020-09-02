@extends('site.index')

@section('content')

@foreach($departments as $department)
	<div class="single-product">
        <div class="product-f-image">
            <img src="{{ Storage::url($department->icon) }}" alt="department_icon" width="300" height="300">
        </div>
        @if(app()->getLocale() == 'ar')
        	<h2>{{$department->department_name_ar}}</h2>
        @else
        	<h2>{{$department->department_name_en}}</h2>
        @endif

        <div class="product-carousel-price">
            <ins>$400.00</ins> <del>$425.00</del>
        </div>                                 
    </div>
	<div class="clear-fix"></div>
	<!-- <h1>
		{{$department->department_name_ar}}
	</h1>	 -->
@endforeach

@endsection