@extends('admin.index')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('design/adminpanel/css/select2.min.css') }}">
@push('js')
<script type="text/javascript" src="{{ asset('design/adminpanel/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endpush
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['route' => 'products.store', 'files' => true]) !!}
            <a href="#" class="btn btn-primary">{{__('admin.save')}}<i class="fa fa-floppy-o"></i></a>
            <a href="#" class="btn btn-success">{{__('admin.save_and_continue')}}<i class="fa fa-floppy-o"></i></a>
            <a href="#" class="btn btn-info">{{__('admin.copy_product')}}<i class="fa fa-file"></i></a>
            <a href="#" class="btn btn-danger">{{__('admin.delete')}}<i class="fa fa-trash"></i></a>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#product_info">{{__('admin.product_info')}}<i class="fa fa-info"></i></a></li>
                    <li><a data-toggle="tab" href="#department">{{__('admin.department')}}<i class="fa fa-list"></i></a></li>
                    <li><a data-toggle="tab" href="#product_setting">{{__('admin.product_setting')}}<i class="fa fa-cog"></i></a></li>
                    <li><a data-toggle="tab" href="#product_media">{{__('admin.product_media')}}<i class="fa fa-photo"></i></a></li>
                    <li><a data-toggle="tab" href="#product_size_weight">{{__('admin.product_size_weight')}}<i class="fa fa-info-circle"></i></a></li>
                    <li><a data-toggle="tab" href="#other_data">{{__('admin.other_data')}}<i class="fa fa-database"></i></a></li>
                </ul>
                <div class="tab-content">
                    @include('admin.products.tabs.product_info')
                    @include('admin.products.tabs.department')
                    @include('admin.products.tabs.product_setting')
                    @include('admin.products.tabs.product_media')
                    @include('admin.products.tabs.product_size_weight')
                    @include('admin.products.tabs.other_data')
                </div>
                <hr />
                <a href="#" class="btn btn-primary">{{__('admin.save')}}<i class="fa fa-floppy-o"></i></a>
                <a href="#" class="btn btn-success">{{__('admin.save_and_continue')}}<i class="fa fa-floppy-o"></i></a>
                <a href="#" class="btn btn-info">{{__('admin.copy_product')}}<i class="fa fa-file"></i></a>
                <a href="#" class="btn btn-danger">{{__('admin.delete')}}<i class="fa fa-trash"></i></a>
                <div class="form-group">
                    {!! Form::label('name_ar', __('admin.name_ar')) !!}
                    {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name_en', __('admin.name_en')) !!}
                    {!! Form::text('name_en', old('name_en'), ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit(__('admin.add'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>
@endsection