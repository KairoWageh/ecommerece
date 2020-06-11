@extends('admin.index')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['route' => 'countries.store', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('country_name_ar', __('admin.name_ar')) !!}
                    {!! Form::text('country_name_ar', old('country_name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_name_en', __('admin.name_en')) !!}
                    {!! Form::text('country_name_en', old('country_name_en'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_code', __('admin.country_code')) !!}
                    {!! Form::text('country_code', old('country_code'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_iso_code', __('admin.country_iso_code')) !!}
                    {!! Form::text('country_iso_code', old('country_iso_code'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_currency', __('admin.country_currency')) !!}
                    {!! Form::text('country_currency', old('country_currency'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_flag', __('admin.country_flag')) !!}
                    {!! Form::file('country_flag', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit(__('admin.add'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>



<!--  -->
@endsection