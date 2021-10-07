@push('js')
<script type="text/javascript">
	var max_input = 10;
	var input_count = 1;
	$(document).on('click', '.add_input', function(){
		if(input_count < max_input){
			$('.div_inputs').append(
				'<div>'+
					'<div class="col-sm-6">'+
						'{!! Form::label('input_key', __('input_key')) !!}'+
						'{!! Form::text('input_key[]', '', ['class' => 'form-control']) !!}'+
					'</div>'+
					'<div class="col-sm-6">'+
						'{!! Form::label('input_value', __('input_value')) !!}'+
						'{!! Form::text('input_value[]', '', ['class' => 'form-control']) !!}'+
					'</div>'+
					'<div class="clearfix"></div>'+
					'<br>'+
					'<a href="#" class="remove_input btn btn-danger"><i class="fa fa-trash"></i></a>'+
				'</div>'
			);
			input_count++;
			console.log('count after adding:::'+input_count);
		}

		return false;
	});

	$(document).on('click', '.remove_input', function(){
		$(this).parent('div').remove();
		input_count--;
		console.log('count after removing:::'+input_count);
		return false;
	});
</script>
@endpush

<div id="other_data" class="tab-pane fade">
	<h3>{{__('other_data')}}</h3>
	<div class="div_inputs col-sm-12">
		@foreach($product->other_data()->get() as $other_data)
		<div>
			<div class="col-sm-6">
				{!! Form::label('input_key', __('input_key')) !!}
				{!! Form::text('input_key[]', $other_data->data_key, ['class' => 'form-control']) !!}
			</div>
			<div class="col-sm-6">
				{!! Form::label('input_value', __('input_value')) !!}
				{!! Form::text('input_value[]', $other_data->data_value, ['class' => 'form-control']) !!}
			</div>
			<div class="clearfix"></div>
			<br>
			<a href="#" class="remove_input btn btn-danger"><i class="fa fa-trash"></i></a>
		</div>
		@endforeach
	</div>
	<div class="clearfix"></div>
	<br>
	<a href="#" class="add_input btn btn-info"><i class="fa fa-plus"></i></a>
	<div class="clearfix"></div>
	<br>
</div>
