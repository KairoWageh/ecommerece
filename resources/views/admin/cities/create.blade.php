@extends('admin.layouts.index')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['route' => 'cities.store']) !!}
                <div class="form-group">
                    {!! Form::label('city_name_ar', __('admin.name_ar')) !!}
                    {!! Form::text('city_name_ar', old('city_name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('city_name_en', __('admin.name_en')) !!}
                    {!! Form::text('city_name_en', old('city_name_en'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_id', __('admin.country')) !!}
                    {!! Form::select('country_id', $countries, null, ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit(__('admin.add'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>



<!--  -->
@endsection
