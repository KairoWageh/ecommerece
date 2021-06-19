@extends('admin.index')
@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">{{ $title }}</h3>
	</div>
	<div class="box-body">
		{!! Form::open(['url' => adminURL('admin/settings'), 'files' => true]) !!}
		<div class="form-group">
			{!! Form::label('sitename_ar', __('sitename_ar')) !!}
			{!! Form::text('sitename_ar', setting()->sitename_ar, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('sitename_en', __('sitename_en')) !!}
			{!! Form::text('sitename_en', setting()->sitename_en, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('email', __('email')) !!}
			{!! Form::text('email', setting()->email, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('logo', __('logo')) !!}
			{!! Form::file('logo', ['class' => 'form-control']) !!}
			<img src="{{ Storage::url(setting()->logo) }}" width="30px" height="30px">
		</div>
		<div class="form-group">
			{!! Form::label('icon', __('icon')) !!}
			{!! Form::file('icon', ['class' => 'form-control']) !!}
			<img src="{{ Storage::url(setting()->icon) }}" width="30px" height="30px">
		</div>
		<div class="form-group">
			{!! Form::label('description', __('description_ar')) !!}
			{!! Form::textarea('description_ar', setting()->description_ar, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('description', __('description_en')) !!}
			{!! Form::textarea('description_en', setting()->description_en, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('keywords', __('keywords')) !!}
			{!! Form::textarea('keywords', setting()->keywords, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('main_lang', __('main_lang')) !!}
			{!! Form::select('main_lang', ['en' => 'English', 'ar' => 'العربية'], setting()->main_lang, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('status', __('status')) !!}
			{!! Form::select('status', ['open' => __('open'), 'close' => __('close')], setting()->status, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('message_maintenance', __('message_maintenance')) !!}
			{!! Form::textarea('message_maintenance', setting()->message_maintenance, ['class' => 'form-control']) !!}
		</div>
		{!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
		{!! Form::close() !!}
	</div>
</div>
@endsection
