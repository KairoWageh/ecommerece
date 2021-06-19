@extends('admin.layouts.auth_app')
@section('content')
	<div class="login-head">
		<h1>{{__('login')}}</h1>
	</div>
	<div class="login-block">
		<form method="post">
			{!! csrf_field() !!}
			<input type="text" name="email" placeholder="{{__('email')}}" required="">
			<input type="password" name="password" class="lock" placeholder="{{__('password')}}">
			<div class="forgot-top-grids">
				<div class="forgot-grid">
					<ul>
						<li>
							<input type="checkbox" id="brand1" name="rememberme" value="1">
							<label for="brand1"><span></span>{{__('remember_me')}}</label>
						</li>
					</ul>
				</div>
				<div class="forgot">
					<a href="{{url('admin/forgot/password')}}">{{__('forgot_password')}}</a>
				</div>
				<div class="clearfix"> </div>
			</div>
			<input type="submit" name="Sign In" value="{{__('login')}}">
			<!-- <h3>Not a member?<a href="signup.html"> Sign up now</a></h3>				 -->
			<h2>{{__('or_login_with')}}</h2>
			<div class="login-icons">
				<ul>
					<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
				</ul>
			</div>
		</form>
		<!-- <h5><a href="{{ route('home') }}">Go Back to Home</a></h5> -->
	</div>
@endsection
