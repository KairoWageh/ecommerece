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
</script>
@endpush
<div id="product_setting" class="tab-pane fade">
	<h3>{{__('product_setting')}}</h3>

	<div class="form-group col-md-6 col-lg-3 col-sm-6 col-xs-12">
		{!! Form::label('price', __('price')) !!}
 		{!! Form::text('price', $product->price, ['class' => 'form-control', 'placeholder' => __('price')]) !!}
	</div>

	<div class="form-group col-md-6 col-lg-3 col-sm-6 col-xs-12">
		{!! Form::label('stock', __('admin.stock')) !!}
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
 		{!! Form::text('offer_price', $product->offer_price, ['class' => 'form-control', 'placeholder' => __('offer_price')]) !!}
	</div>

	<div class="form-group col-md-6 col-lg-4 col-sm-6 col-xs-12">
		{!! Form::label('start_offer_at', __('start_offer_at')) !!}
 		{!! Form::text('start_offer_at', $product->start_offer_at, ['class' => 'form-control datepicker', 'placeholder' => __('start_offer_at')]) !!}
	</div>

	<div class="form-group col-md-6 col-lg-4 col-sm-6 col-xs-12">
		{!! Form::label('end_offer_at', __('end_offer_at')) !!}
 		{!! Form::text('end_offer_at', $product->end_offer_at, ['class' => 'form-control datepicker', 'placeholder' => __('end_offer_at')]) !!}
	</div>

	<div class="clearfix"></div>
	<hr>
	<div class="form-group">
		{!! Form::label('product_status', __('product_status')) !!}
 		{!! Form::select('product_status', ['pending' => __('pending'), 'refused' => __('refused'), 'active' => __('active')], $product->product_status, ['class' => 'form-control status', 'placeholder' => __('admin.product_status')]) !!}
	</div>

	<div class="form-group reason {{ $product->status != 'refused'?'hidden':'' }}">
		{!! Form::label('reason', __('refused_reason')) !!}
 		{!! Form::textarea('reason', $product->reason, ['class' => 'form-control', 'placeholder' => __('refused_reason')]) !!}
	</div>
</div>
