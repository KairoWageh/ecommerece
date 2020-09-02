@extends('admin.layouts.auth_app')
@section('content')
	<div class="login-head">
		<h1>Login</h1>
	</div>
	<div class="login-block">
		<form method="post" autocomplete="off">
			{!! csrf_field() !!}
			<input type="text" name="email" value="{{$data->email}}" placeholder="Email" required="">
			<input type="password" name="password"  class="lock" placeholder="Password" autocomplete="off">
			<input type="password" name="password_confirmation" class="lock" placeholder="Password">
			<div class="forgot-top-grids">
				<div class="forgot-grid">
					<ul>
						<li>
							<input type="checkbox" id="brand1" name="rememberme" value="1">
							<label for="brand1"><span></span>Remember me</label>
						</li>
					</ul>
				</div>
			</div>
			<input type="submit" name="reset" value="Reset">	
			<h3>Not a member?<a href="signup.html"> Sign up now</a></h3>				
			<h2>or login with</h2>
			<div class="login-icons">
				<ul>
					<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>						
				</ul>
			</div>
		</form>
		<h5><a href="index.html">Go Back to Home</a></h5>
	</div>
@endsection						
