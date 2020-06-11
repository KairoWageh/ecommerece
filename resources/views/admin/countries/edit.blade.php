@extends('admin.index')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['route' => ['countries.update', $country->id], 'files' => true, 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('country_name_ar', __('admin.name_ar')) !!}
                    {!! Form::text('country_name_ar', old('country_name_ar', $country->country_name_ar), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_name_en', __('admin.name_en')) !!}
                    {!! Form::text('country_name_en', old('country_name_en', $country->country_name_en), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_code', __('admin.country_code')) !!}
                    {!! Form::text('country_code', old('country_code', $country->country_code), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_iso_code', __('admin.country_iso_code')) !!}
                    {!! Form::text('country_iso_code',  old('country_iso_code', $country->country_iso_code), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_currency', __('admin.country_currency')) !!}
                    {!! Form::text('country_currency',  old('country_currency', $country->country_currency), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_flag', __('admin.country_flag')) !!}
                    {!! Form::file('country_flag', ['class' => 'form-control']) !!}
                    <img src="{{Storage::url($country->country_flag)}}" width="30px" height="30px">
                </div>
                {!! Form::submit(__('admin.edit'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>



<!--  -->
@endsection