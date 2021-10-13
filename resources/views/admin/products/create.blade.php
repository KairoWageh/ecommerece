@extends('admin.layouts.index')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/design/admin/css/select2.min.css') }}">
    @push('js')
        <script type="text/javascript" src="{{ asset('public/design/admin/js/select2.min.js') }}"></script>
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
{{--        <!-- {!! Form::open(['route' => ['products.update', $product->id],  'method' => 'put', 'files' => true, 'id' => 'product_form']) !!} -->--}}
        {!! Form::open(['url' => adminURL('admin/products'),  'method' => 'post', 'files' => true, 'id' => 'product_create_form']) !!}
        <!-- @csrf -->
{{--            <a href="#" class="btn btn-danger delete" data-toggle="modal" data-target="#delete_admin{{ $product->id }}">{{__('delete')}}<i class="fa fa-trash"></i></a>--}}
            <div class="alert alert-danger error_message" style="visibility: hidden">
                <ul class="validate_message">
                </ul>
            </div>
            <div class="alert alert-success success_message hidden" style="visibility: hidden">

            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#product_info">{{__('product_info')}}<i class="fa fa-info"></i></a></li>
                <li><a data-toggle="tab" href="#department">{{__('department')}}<i class="fa fa-list"></i></a></li>
                <li><a data-toggle="tab" href="#product_setting">{{__('product_setting')}}<i class="fa fa-cog"></i></a></li>
                <li><a data-toggle="tab" href="#product_media">{{__('product_media')}}<i class="fa fa-photo"></i></a></li>
                <li><a data-toggle="tab" href="#product_size_weight">{{__('shippingInfo')}}<i class="fa fa-info-circle"></i></a></li>
                <li><a data-toggle="tab" href="#other_data">{{__('other_data')}}<i class="fa fa-database"></i></a></li>
                <li><a data-toggle="tab" href="#related_products">{{__('related_products')}}<i class="fa fa-list"></i></a></li>
            </ul>
            <div class="tab-content">
                @include('admin.products.tabs.product_info')
                @include('admin.products.tabs.department')
                @include('admin.products.tabs.product_setting')
{{--                @include('admin.products.tabs.product_media')--}}
{{--                @include('admin.products.tabs.product_size_weight')--}}
{{--                @include('admin.products.tabs.other_data')--}}
{{--                @include('admin.products.tabs.related_products')--}}
            </div>
            <hr />
            <a href="#" class="btn btn-primary">{{__('save')}}<i class="fa fa-floppy-o"></i></a>
        <!-- <div class="form-group">
                    {!! Form::label('name_ar', __('name_ar')) !!}
        {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
{!! Form::label('name_en', __('name_en')) !!}
        {!! Form::text('name_en', old('name_en'), ['class' => 'form-control']) !!}
            </div> -->

        <!-- {!! Form::submit(__('add'), ['class' => 'btn btn-primary']) !!} -->
            {!! Form::close() !!}
        </div>
        <!-- //box-body -->
    </div>
    <!-- //box -->
    <!-- Modal -->
{{--    <div id="delete_admin{{ $product->id }}" class="modal fade" role="dialog">--}}
        <div class="modal-dialog">

        </div>
    </div>
    </div>
    </div>
@endsection
