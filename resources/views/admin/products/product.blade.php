@extends('admin.layouts.index')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/design/adminpanel/css/select2.min.css') }}">
@push('js')
<script type="text/javascript" src="{{ asset('public/design/adminpanel/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $(document).on('click', '.save_and_continue', function(){
            var form_data = $('#product_form').serialize();
            // var url = '{{ adminURL("products/".$product->id) }}';
            var url =  '{{ url("admin/products/".$product->id) }}';
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'post',
                data: form_data,
                beforeSend: function(){
                    $('.loading_save_continue').removeClass('hidden');
                    $('.validate_message').html('');
                    $('.error_message').addClass('hidden');
                    $('.success_message').html('').addClass('hidden');
                }, success: function(data){
                    if(data.status == true){
                        $('.loading_save_continue').addClass('hidden');
                        $('.success_message').html('<h1>'+data.message+'</h1>').removeClass('hidden');
                    }

                }, error(response){
                    $('.loading_save_continue').addClass('hidden');
                    var error_li = '';
                    $.each(response.responseJSON.errors, function(index, value){
                        error_li += '<li>' + value + '</li>';
                    });
                    $('.validate_message').html(error_li);
                    $('.error_message').removeClass('hidden');
                }
            });
            return false;
        });

        $(document).on('click', '.copy_product', function(){
            var form_data = $('#product_form').serialize();
            // var url = '{{ adminURL("products/".$product->id) }}';
            var url =  '{{ url("admin/products/copy/".$product->id) }}';
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'post',
                data: {_token: '{{ csrf_token() }}'},
                beforeSend: function(){
                    $('.loading_copy').removeClass('hidden');
                    $('.validate_message').html('');
                    $('.error_message').addClass('hidden');
                    $('.success_message').html('').addClass('hidden');
                }, success: function(data){
                    if(data.status == true){
                        $('.loading_copy').addClass('hidden');
                        $('.success_message').html('<h1>'+data.message+'</h1>').removeClass('hidden');
                        setTimeout(function(){
                            window.location.href = '{{ url("admin/products") }}' +'/'+ data.id + '/edit';
                        }, 5000);
                    }

                }, error(response){
                    $('.loading_copy').addClass('hidden');
                    var error_li = '';
                    $.each(response.responseJSON.errors, function(index, value){
                        error_li += '<li>' + value + '</li>';
                    });
                    $('.validate_message').html(error_li);
                    $('.error_message').removeClass('hidden');
                }
            });
            return false;
        });
    });
</script>
@endpush
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            <!-- {!! Form::open(['route' => ['products.update', $product->id],  'method' => 'put', 'files' => true, 'id' => 'product_form']) !!} -->
            {!! Form::open(['url' => adminURL('products'),  'method' => 'put', 'files' => true, 'id' => 'product_form']) !!}
            <!-- @csrf -->
            <a href="#" class="btn btn-primary">{{__('save')}}<i class="fa fa-floppy-o"></i></a>
            <a href="#" class="btn btn-success save_and_continue">{{__('save_and_continue')}}<i class="fa fa-floppy-o"></i><i class="fa fa-spin fa-spinner loading_save_continue hidden"></i></a>
            <a href="#" class="btn btn-info copy_product">{{__('copy_product')}}<i class="fa fa-file"></i><i class="fa fa-spin fa-spinner loading_copy hidden"></i></a>
            <a href="#" class="btn btn-danger delete" data-toggle="modal" data-target="#delete_admin{{ $product->id }}">{{__('delete')}}<i class="fa fa-trash"></i></a>
            <div class="alert alert-danger error_message hidden">
                <ul class="validate_message">
                </ul>
            </div>
            <div class="alert alert-success success_message hidden">

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
                    @include('admin.products.tabs.product_media')
                    @include('admin.products.tabs.product_size_weight')
                    @include('admin.products.tabs.other_data')
                    @include('admin.products.tabs.related_products')
                </div>
                <hr />
                <a href="#" class="btn btn-primary">{{__('save')}}<i class="fa fa-floppy-o"></i></a>
                <a href="#" class="btn btn-success save_and_continue">{{__('save_and_continue')}}<i class="fa fa-floppy-o"></i><i class="fa fa-spin fa-spinner loading_save_continue hidden"></i></a>
                <a href="#" class="btn btn-info copy_product">{{__('copy_product')}}<i class="fa fa-file"></i><i class="fa fa-spin fa-spinner loading_copy hidden"></i></a>
                <a href="#" class="btn btn-danger">{{__('delete')}}<i class="fa fa-trash"></i></a>
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
    <div id="delete_admin{{ $product->id }}" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{__('delete')}}</h4>
          </div>
          {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
          <div class="modal-body">
            <div class="alert alert-danger">
                <h4>
                    {{__('delete_record')}}
                </h4>
            </div>
          </div>
          <div class="modal-footer">
            {!! Form::submit(__('delete'), ['class' => 'btn btn-danger']) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('close') }}</button>
          </div>
          {!! Form::close() !!}
        </div>

      </div>
    </div>
        </div>
    </div>
@endsection
