@extends('admin.index')
@section('content')
@push('js')
<!-- map --> 
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCAwAe-4ZAkrazqIDfFUf8q58_yxulVy9Y'></script>
<script type="text/javascript" src='{{asset("public/design/adminpanel/js/locationpicker.jquery.js")}}'></script>
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
            {!! Form::open(['route' => ['manufacturers.update', $manufacturer->id], 'method' => 'put', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('name_ar', __('admin.name_ar')) !!}
                    {!! Form::text('name_ar', old('name_ar', $manufacturer->name_ar), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name_en', __('admin.name_en')) !!}
                    {!! Form::text('name_en', old('name_en', $manufacturer->name_en), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('contact_name', __('admin.contact_name')) !!}
                    {!! Form::text('contact_name', old('contact_name', $manufacturer->contact_name), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', __('admin.email')) !!}
                    {!! Form::text('email', old('email', $manufacturer->email), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('mobile', __('admin.mobile')) !!}
                    {!! Form::text('mobile', old('mobile', $manufacturer->mobile), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', __('admin.address')) !!}
                    {!! Form::text('address', old('address', $manufacturer->address), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <div id="us1" style="width: 500px; height: 400px;"></div>
                </div>
                <div class="form-group">
                    {!! Form::label('facebook', __('admin.facebook')) !!}
                    {!! Form::text('facebok', old('facebook', $manufacturer->facebook), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('twitter', __('admin.twitter')) !!}
                    {!! Form::text('twitter', old('twitter', $manufacturer->twitter), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('icon', __('admin.manufacturers_icon')) !!}
                    {!! Form::file('icon', ['class' => 'form-control']) !!}
                </div>
                @if(!empty($manufacturer->icon) and Storage::has($manufacturer->icon))
                <img src="{{ Storage::url($manufacturer->icon) }}" width="30px" height="30px">
                @endif
                {!! Form::submit(__('admin.edit'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>



<!--  -->
@endsection
