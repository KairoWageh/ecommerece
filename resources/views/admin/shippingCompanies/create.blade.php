@extends('admin.index')
@section('content')
@push('js')
<!-- map --> 
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCAwAe-4ZAkrazqIDfFUf8q58_yxulVy9Y'></script>
<script type="text/javascript" src='{{asset("design/adminpanel/js/locationpicker.jquery.js")}}'></script>
<script>
    $('#us1').locationpicker({
        location: {
            latitude: 46.15242437752303,
            longitude: 2.7470703125
        },
        radius: 300,
        markerIcon: 'http://www.iconsdb.com/icons/preview/tropical-blue/map-marker-2-xl.png',
        inputBinding: {
            latitudeInput: $('#lat'),
            longitudeInput: $('#long'),
            //radiusInput: $('#us2-radius'),
            // locationNameInput: $('#us2-address')
        }

    });
</script>
@endpush
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['route' => 'shippingCompanies.store', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('name_ar', __('admin.name_ar')) !!}
                    {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name_en', __('admin.name_en')) !!}
                    {!! Form::text('name_en', old('name_en'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('user_id', __('admin.user')) !!}
                    {!! Form::select('user_id', $companies, old('user_id'), ['class' => 'form-control', 'placeholder' => '.........']) !!}
                </div>
                <div class="form-group">
                    <div id="us1" style="width: 500px; height: 400px;"></div>
                </div>
                <div class="form-group">
                    {!! Form::label('icon', __('admin.shipping_icon')) !!}
                    {!! Form::file('icon', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit(__('admin.add'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>
<!--  -->
@endsection