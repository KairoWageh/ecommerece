@push('js')
<script type="text/javascript">
	$('.datepicker').datepicker({
		rtl: '{{session("lang") == "ar"? true: false}}',
		language: '{{session("lang")}}',
		format: 'yyyy-mm-dd',
		autoclose: false,
		todayBtn: 'linked',
		clearBtn: true,
	});
	$(document).on('change', '.status', function(){
		var status = $('.status option:selected').val();
		if(status == 'refused'){
			$('.reason').removeClass('hidden');
		}else{
			$('.reason').addClass('hidden');
		}
	})
    // save product into db
    function save_product(data){
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

    {{--// add admin form submition--}}
    {{--$('#add_product_setting').on('submit',function(event){--}}
    {{--    event.preventDefault();--}}
    {{--    // get form submitted data--}}
    {{--    let formData = new FormData(this);--}}
    {{--    var product_id = $('.saved_product_id').val();--}}
    {{--    document.cookie = 'product_id='+product_id;--}}
    {{--    var url = "{{url('admin/products/:product_id')}}";--}}
    {{--    url = url.replace(":product_id", product_id);--}}
    {{--    $.ajax({--}}
    {{--        url: url,--}}
    {{--        type:"PATCH",--}}
    {{--        data: formData,--}}
    {{--        contentType: false,--}}
    {{--        processData: false,--}}
    {{--        success:function(response){--}}

    {{--        },--}}
    {{--        error: function (xhr) {--}}
    {{--            $('.validation-errors').html('');--}}
    {{--            $.each(xhr.responseJSON.errors, function(key,value) {--}}
    {{--                $('.validation-errors').append('<p style="color: red">'+value+'</p');--}}
    {{--            });--}}
    {{--        },--}}
    {{--    });--}}
    {{--});--}}
    {{--// saving data from product info tab--}}
    {{--$('.save_product_settings').click(function(){--}}
    {{--    var product_id = $('.saved_product_id').val();--}}
    {{--    document.cookie = 'product_id='+product_id;--}}
    {{--    var url = "{{url('admin/products/:product_id')}}";--}}
    {{--    url = url.replace(":product_id", product_id);--}}
    {{--    var price = $('#price');--}}
    {{--     $.ajax({--}}
    {{--         url: url,--}}
    {{--         type:"PATCH",--}}
    {{--         data: {"price": price},--}}
    {{--         contentType: false,--}}
    {{--         processData: false,--}}
    {{--         success:function(response){--}}

    {{--         },--}}
    {{--         error: function (xhr) {--}}
    {{--             $('.validation-errors').html('');--}}
    {{--             $.each(xhr.responseJSON.errors, function(key,value) {--}}
    {{--                 $('.validation-errors').append('<p style="color: red">'+value+'</p');--}}
    {{--             });--}}
    {{--         },--}}
    {{--    });--}}
    {{--});--}}
</script>
@endpush
<div id="product_setting" class="tab-pane fade">
    <div class="tab_title">
	    <h3 >{{__('product_setting')}}</h3>
    </div>
    <?php if(isset($_COOKIE['product_id'])){
                $product_id = ($_COOKIE['product_id']);
          }else{
        $product_id = 0;
    }
    ?>
    <div class="clearfix"></div>
    {!! Form::open(['id' => 'add_product_setting', 'route' => ['products.update', $product_id],  'method' => 'POST']) !!}
    {{ method_field('PATCH') }}
    @if(isset($product))
	<div class="form-group col-md-6 col-lg-3 col-sm-6 col-xs-12">
		{!! Form::label('price', __('price')) !!}
 		{!! Form::text('price', $product->price, ['class' => 'form-control', 'placeholder' => __('price')]) !!}
	</div>

	<div class="form-group col-md-6 col-lg-3 col-sm-6 col-xs-12">
		{!! Form::label('stock', __('stock')) !!}
 		{!! Form::text('stock', $product->stock, ['class' => 'form-control', 'placeholder' => __('stock')]) !!}
	</div>

	<div class="form-group col-md-6 col-lg-3 col-sm-6 col-xs-12">
		{!! Form::label('start_at', __('start_at')) !!}
 		{!! Form::text('start_at', $product->start_at, ['class' => 'form-control datepicker', 'placeholder' => __('start_at')]) !!}
	</div>

	<div class="form-group col-md-6 col-lg-3 col-sm-6 col-xs-12">
		{!! Form::label('end_at', __('end_at')) !!}
 		{!! Form::text('end_at', $product->end_at, ['class' => 'form-control datepicker', 'placeholder' => __('end_at')]) !!}
	</div>

	<div class="clearfix"></div>
	<hr>
	<div class="form-group col-md-6 col-lg-4 col-sm-6 col-xs-12">
		{!! Form::label('offer_price', __('offer_price')) !!}
 		{!! Form::text('offer_price', $product->offer_price, ['class' => 'form-control', 'id' => 'offer_price', 'placeholder' => __('offer_price')]) !!}
	</div>

	<div class="form-group col-md-6 col-lg-4 col-sm-6 col-xs-12">
		{!! Form::label('start_offer_at', __('start_offer_at')) !!}
 		{!! Form::text('start_offer_at', $product->start_offer_at, ['class' => 'form-control datepicker', 'id' => 'start_offer_at', 'placeholder' => __('start_offer_at')]) !!}
	</div>

	<div class="form-group col-md-6 col-lg-4 col-sm-6 col-xs-12">
		{!! Form::label('end_offer_at', __('end_offer_at')) !!}
 		{!! Form::text('end_offer_at', $product->end_offer_at, ['class' => 'form-control datepicker', 'id' => 'end_offer_at', 'placeholder' => __('end_offer_at')]) !!}
	</div>

	<div class="clearfix"></div>
	<hr>
	<div class="form-group">
		{!! Form::label('product_status', __('product_status')) !!}
 		{!! Form::select('product_status', ['pending' => __('pending'), 'refused' => __('refused'), 'active' => __('active')], $product->product_status, ['class' => 'form-control status', 'placeholder' => __('product_status')]) !!}
	</div>

	<div class="form-group reason {{ $product->status != 'refused'?'hidden':'' }}">
		{!! Form::label('reason', __('refused_reason')) !!}
 		{!! Form::textarea('reason', $product->reason, ['class' => 'form-control', 'placeholder' => __('refused_reason')]) !!}
	</div>
    @else
        <div class="form-group settings col-md-6 col-lg-3 col-sm-6 col-xs-12">
            {!! Form::label('price', __('price')) !!}
            {!! Form::text('price', '', ['class' => 'form-control', 'placeholder' => __('price')]) !!}
        </div>

        <div class="form-group settings col-md-6 col-lg-3 col-sm-6 col-xs-12">
            {!! Form::label('stock', __('stock')) !!}
            {!! Form::text('stock', '', ['class' => 'form-control', 'placeholder' => __('stock')]) !!}
        </div>

        <div class="form-group settings col-md-6 col-lg-3 col-sm-6 col-xs-12">
            {!! Form::label('start_at', __('start_at')) !!}
            {!! Form::text('start_at', '', ['class' => 'form-control datepicker', 'placeholder' => __('start_at')]) !!}
        </div>

        <div class="form-group settings col-md-6 col-lg-3 col-sm-6 col-xs-12">
            {!! Form::label('end_at', __('end_at')) !!}
            {!! Form::text('end_at', '', ['class' => 'form-control datepicker', 'placeholder' => __('end_at')]) !!}
        </div>

{{--        <div class="clearfix"></div>--}}
{{--        <hr>--}}
{{--        <div class="form-group settings col-md-6 col-lg-4 col-sm-6 col-xs-12">--}}
{{--            {!! Form::label('offer_price', __('offer_price')) !!}--}}
{{--            {!! Form::text('offer_price', '', ['class' => 'form-control', 'placeholder' => __('offer_price')]) !!}--}}
{{--        </div>--}}

{{--        <div class="form-group settings col-md-6 col-lg-4 col-sm-6 col-xs-12">--}}
{{--            {!! Form::label('start_offer_at', __('start_offer_at')) !!}--}}
{{--            {!! Form::text('start_offer_at', '', ['class' => 'form-control datepicker', 'placeholder' => __('start_offer_at')]) !!}--}}
{{--        </div>--}}

{{--        <div class="form-group settings col-md-6 col-lg-4 col-sm-6 col-xs-12">--}}
{{--            {!! Form::label('end_offer_at', __('end_offer_at')) !!}--}}
{{--            {!! Form::text('end_offer_at', '', ['class' => 'form-control datepicker', 'placeholder' => __('end_offer_at')]) !!}--}}
{{--        </div>--}}

        <div class="clearfix"></div>
        <hr>
        <div class="form-group">
            {!! Form::label('product_status', __('product_status')) !!}
            {!! Form::select('product_status', ['pending' => __('pending'), 'refused' => __('refused'), 'active' => __('active')], '', ['class' => 'form-control status', 'placeholder' => __('product_status')]) !!}
        </div>

{{--        <div class="form-group reason {{ $product->status != 'refused'?'hidden':'' }}">--}}
{{--            {!! Form::label('reason', __('refused_reason')) !!}--}}
{{--            {!! Form::textarea('reason', $product->reason, ['class' => 'form-control', 'placeholder' => __('refused_reason')]) !!}--}}
{{--        </div>--}}
    @endif
{{--    {!! Form::submit(__('save'),['class' => 'btn btn-primary']) !!}--}}
    <a href="#" class="btn btn-primary save_product_settings">{{__('save')}}<i class="fa fa-floppy-o"></i></a>
    {!! Form::close() !!}
</div>
