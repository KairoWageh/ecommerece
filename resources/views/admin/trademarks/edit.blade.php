@extends('admin.index')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['route' => ['trademarks.update', $tradeMark->id], 'method' => 'put', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('name_ar', __('admin.name_ar')) !!}
                    {!! Form::text('name_ar', old('name_ar', $tradeMark->name_ar), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name_en', __('admin.name_en')) !!}
                    {!! Form::text('name_en', old('name_en', $tradeMark->name_en), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('trademarkIcon', __('admin.trademarkIcon')) !!}
                    {!! Form::file('trademarkIcon', ['class' => 'form-control']) !!}
                    <img src="{{Storage::url($tradeMark->trademarkIcon)}}" width="30x" height="30px">
                </div>
                {!! Form::submit(__('admin.edit'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>
<!--  -->
@endsection