@extends('admin.layouts.auth_app')
@section('content')
	<div class="login-head">
		<h1>Reset password</h1>
	</div>
	<div class="login-block">
		<form method="post">
			{!! csrf_field() !!}
			<input type="text" name="email" placeholder="Email" required="">
			<input type="submit" name="Reset" value="Reset">	
		</form>
		<h5><a href="{{route('adminLogin')}}">Sign in</a></h5>
	</div>
@endsection		
