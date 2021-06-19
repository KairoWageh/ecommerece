@extends('admin.index')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['route' => 'admin.store']) !!}
                <div class="form-group">
                    {!! Form::label('name', __('name')) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', __('email')) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', __('password')) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit(__('addNewAdmin'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>



<!--  -->
@endsection
