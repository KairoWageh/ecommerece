@push('js')
<script type="text/javascript">
	$(document).ready(function () {
		var dataSelect = [
			@foreach(App\Country::all() as $country)
			{
				"text": "{{ $country->{'country_name_'.lang()} }}",
				"children":[
					@foreach($country->malls()->get() as $mall)
					{
						"id": "{{ $mall->id }}",
						"text" : "{{ $mall->{'name_'.lang()} }}",
						@if(check_mall($product->id, $mall->id))
						"selected" : true
						@endif
					},
					@endforeach
				],
			},
			@endforeach
		];
		$('.mall_select2').select2({data: dataSelect});
	});
</script>
@endpush

<div id="product_size_weight" class="tab-pane fade">
	<h3>{{__('shippingInfo')}}</h3>
	<div class="shippingInfo">
		<center><h1>{{__('please_choose_department')}}</h1></center>
	</div>
	<div class="info_data hidden col-md-12">
		<div class="form-group col-sm-4 col-xs-12">
		    {!! Form::label('color_id', __('color')) !!}
			{!! Form::select('color_id', App\Color::pluck('name_'.lang(), 'id'), $product->color_id, ['class' => 'form-control', 'placeholder' => __('color')]) !!}
		</div>
		<div class="form-group col-sm-4 col-xs-12">
		    {!! Form::label('trade_mark_id', __('trademark')) !!}
			{!! Form::select('trade_mark_id', App\TradeMark::pluck('name_'.lang(), 'id'), $product->trade_mark_id, ['class' => 'form-control', 'placeholder' => __('trademark')]) !!}
		</div>
		<div class="form-group col-sm-4 col-xs-12">
		    {!! Form::label('manu_id', __('manufacture')) !!}
			{!! Form::select('manu_id', App\Manufacturer::pluck('name_'.lang(), 'id'), $product->manu_id, ['class' => 'form-control', 'placeholder' => __('manufacture')]) !!}
		</div>
		<div class="clearfix"></div>
		<div class="col-sm-12">
		    {!! Form::label('malls', __('admin.malls')) !!}
			<select name="mall[]" class="form-control mall_select2" multiple="multiple" style="width:100%">
				<!-- @foreach(App\Country::all() as $country)
					<optgroup label="{{ $country->{'country_name_'.lang()} }}">
						@foreach($country->malls()->get() as $mall)
							<option value="{{ $mall->id }}">{{ $mall->{'name_'.lang()} }}</option>
						@endforeach
					</optgroup>
				@endforeach -->
			</select>
		</div>
		<div class="clearfix"></div>
	</div>



	<!-- <div class="info_data form-group hidden">
		<div class="form-group col-sm-4 col-xs-12">
			{!! Form::label('color_id', __('olor')) !!}
			{!! Form::select('color', App\Color::pluck('name_'.lang(), 'id'), $product->color_id, ['class' => 'form-control', 'placeholder' => __('color')]) !!}
		</div>
		<div class="clearfix"></div>
	</div> -->
</div>
