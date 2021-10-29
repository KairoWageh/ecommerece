@extends('admin.layouts.index')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/design/admin/css/select2.min.css') }}">
    @push('js')
        <script type="text/javascript" src="{{ asset('public/design/admin/js/select2.min.js') }}"></script>
        <script type="text/javascript">
            var department = new Object();
            $(document).ready(function() {
                // remove id from hidden input
                $('.saved_product_id').val('');
                $('.js-example-basic-single').select2();
                $('#jstree').jstree({
                    'core' : {
                        'data' : {!! load_department(old('parent_id')) !!},
                        "themes" : {
                            "variant" : "large"
                        }
                    },
                    "checkbox" : {
                        "keep_selected_style" : false
                    },
                    "plugins" : ["wholerow"]
                });

            });
            // product info start

            $('#jstree').on('changed.jstree', function(e, data){
                var i, j, r = [];
                for(i=0, j=data.selected.length; i<j; i++){
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                $('.parent_id').val(r.join(', '));
                if($('a.jstree-clicked')){
                    department.department_id = document.getElementsByClassName("jstree-clicked")[0].parentElement.id;
                }
            });
            // save product into db
            function save_product_info(data){
                $.ajax({
                    url: "{{url('admin/products')}}",
                    type: "POST",
                    data: {_token: '{{ csrf_token() }}', data: data},
                    success:function(response){
                        // the new product which has been added recently
                        var product = response.product;
                        if(response.toast === 'success'){
                            toastr.success(response.message);
                            $("div.error_message").hide();
                            var tabs = document.getElementById("nav-tabs");
                            for(var i=0; i< tabs.getElementsByClassName("icon").length; i++){
                                var icons = document.getElementsByClassName("icon");
                                icons[i].style.display = "block";
                            }
                            $('.saved_product_id').val(product.id);
                        }else if(response.toast === 'error'){
                            toastr.error(response.message);
                        }
                    }, error(response){
                        var error_li = '';
                        $.each(response.responseJSON.errors, function(index, value){
                            error_li += '<li>' + value + '</li>';
                        });
                        $('.validate_message').html(error_li);
                        $('.error_message').removeAttr('style');
                    }
                });
            }

            function save_product_settings(data){
                var product_id = data.product_id;
                var url = "{{url('admin/products/:product_id/saveProductSettings')}}";
                url = url.replace(':product_id', product_id);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {_token: '{{ csrf_token() }}', data: data},
                    success:function(response){
                        // the new product which has been added recently
                        var product = response.product;
                        if(response.toast === 'success'){
                            toastr.success(response.message);
                            $("div.error_message").hide();
                            var tabs = document.getElementById("nav-tabs");
                            for(var i=0; i< tabs.getElementsByClassName("icon").length; i++){
                                var icons = document.getElementsByClassName("icon");
                                icons[i].style.display = "block";
                            }
                            $('.saved_product_id').val(product.id);
                        }else if(response.toast === 'error'){
                            toastr.error(response.message);
                        }
                    }, error(response){
                        var error_li = '';
                        $.each(response.responseJSON.errors, function(index, value){
                            error_li += '<li>' + value + '</li>';
                        });
                        $('.validate_message').html(error_li);
                        $('.error_message').removeAttr('style');
                    }
                });
            }
            // saving data from product info tab
            $('.save_product_info').click(function(){
                var title = $('.title').val();
                var department_id;
                if(department.department_id){
                    department_id = department.department_id;
                }else{
                    department_id = 0;
                }
                var content = $('.content').val();
                var data = {title, department_id, content};
                save_product_info(data);
                return $.ajax({
                    url: "{{url('admin/products')}}",
                    type: "GET",
                });
            });
            // product info end

            // product settings start
            $('.save_product_settings').click(function(){
                var product_id = $('.saved_product_id').val();
                var price = $('#price').val();
                var stock = $('#stock').val();
                var start_at = $('#start_at').val();
                var end_at = $('#end_at').val();
                // if (document.getElementById("offer_price").value) {
                //     var offer_price = $('#offer_price').val();
                // }else{
                //     var offer_price = 0;
                // }
                // if (document.getElementById("start_offer_at").value) {
                //     var start_offer_at = $('#start_offer_at').val();
                // }else{
                //     var start_offer_at = 0;
                // }
                // if (document.getElementById("end_offer_at").value) {
                //     var end_offer_at = $('#end_offer_at').val();
                // }else{
                //     var end_offer_at = 0;
                // }
                var product_status = $('#product_status').val();
                var data = {product_id, price, stock, start_at, end_at, product_status};
                save_product_settings(data);
                return $.ajax({
                    url: "{{url('admin/products')}}",
                    type: "GET",
                });
            });
            // product settings end

            // upload media start
            $('.upload_product_media').click(function(){
                var product_id = $('.saved_product_id').val();
            });
            // upload media start
        </script>
    @endpush
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <div class="alert alert-danger error_message" style="visibility: hidden">
                <ul class="validate_message">
                </ul>
            </div>
            <ul id="nav-tabs" class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#product_info">{{__('product_info')}}<i class="fa fa-info"></i></a></li>
{{--                <li class="icon" style="display: none"><a data-toggle="tab" href="#department">{{__('department')}}<i class="fa fa-list"></i></a></li>--}}
                <li class="icon" style="display: none"><a data-toggle="tab" href="#product_setting">{{__('product_setting')}}<i class="fa fa-cog"></i></a></li>
{{--                <li class="icon" style="display: none"><a class="upload_product_media" data-toggle="tab" href="#product_media">{{__('product_media')}}<i class="fa fa-image"></i></a></li>--}}
{{--                <li class="icon" style="display: none"><a  data-toggle="tab" href="#product_size_weight">{{__('shippingInfo')}}<i class="fa fa-info-circle"></i></a></li>--}}
{{--                <li class="icon" style="display: none"><a data-toggle="tab" href="#other_data">{{__('other_data')}}<i class="fa fa-database"></i></a></li>--}}
{{--                <li class="icon" style="display: none"><a data-toggle="tab" href="#related_products">{{__('related_products')}}<i class="fa fa-list"></i></a></li>--}}
            </ul>
            <div class="tab-content">
                <input type="hidden" value="" class="saved_product_id"/>
                @include('admin.products.tabs.product_info')
{{--                @include('admin.products.tabs.department')--}}
                @include('admin.products.tabs.product_setting')
{{--                @include('admin.products.tabs.product_media')--}}
{{--                @include('admin.products.tabs.product_size_weight')--}}
{{--                @include('admin.products.tabs.other_data')--}}
{{--                @include('admin.products.tabs.related_products')--}}
            </div>
            <hr />
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
