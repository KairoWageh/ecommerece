@extends('site.layouts.auth_app')
@section('content')
<!-- title -->
<h1>{{__('login')}}</h1>
<!-- //title -->
<!-- content -->
<div class="sub-main-w3">
	<div class="bg-content-w3pvt">
		<div class="top-content-style">
			<img src="{{ asset('public/design/site/img/user.jpg') }}" alt="" />
		</div>
		<form method="post">
			{!! csrf_field() !!}
			@if(session('error'))
	    		<div class="alert alert-danger">
		    		{!! session('error') !!}
		    	</div>
	    	@endif
	    	@if(count($errors->all()) > 0)
				<div class="alert alert-danger">
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</div>
			@endif
			<div class="input">
				<input type="email" placeholder="{{__('email')}}" name="email" required />
				<span class="fa fa-envelope"></span>
			</div>
			<div class="input">
				<input type="password" placeholder="{{__('password')}}" name="password" required />
				<span class="fa fa-unlock"></span>
			</div>
			<button type="submit" class="btn submit">
				<span class="fa fa-sign-in"></span>
			</button>
		</form>
		<a href="#" class="bottom-text-w3ls">{{__('forgot_password')}}</a>
	</div>
</div>
<!-- //content -->
@endsection
