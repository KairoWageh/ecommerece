@push('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '.do_search', function(){
			var search = $('.search').val();
			if(search != '' || search !== null){
				$.ajax({
					url: '{{ url('admin/products/search') }}',
					dataType: 'json',
					type: 'post',
					data: {_token: '{{ csrf_token() }}', search: search, id: '{{ $product->id }}' },
					beforeSend: function(){
						$('.loading_data').removeClass('hidden');
					},success: function(data){
						if(data.status == true){
							if(data.count > 0){
								var items = '';
								$.each(data.result, function(index, value){
									items += '<li><label><input type="checkbox" name="related_products[]" value="'+value.id+'" />'+value.title+'</label></li>';	
								});
								$('.items').html(items);
							}
							$('.loading_data').addClass('hidden');
						}
					}, error: function(data){

					}
				});
			}	
		});
		
	});
</script>
@endpush

<div id="related_products" class="tab-pane fade">
	<h3>{{__('admin.related_products')}}</h3>
	<div class="col-sm-12">
		<form class="form-inline">
			<i class="fa fa-spin fa-spinner fa-2x loading_data hidden" aria-hidden="true"></i>
			<i class="fa fa-search fa-2x do_search" aria-hidden="true"></i>
			<input class="form-control form-control-sm search col-md-6" type="text" placeholder="Search" aria-label="Search">
		</form>

		<hr />
		<div class="col-md-12">
			<ul class="items">
				@foreach($product->related_products()->get() as $related_product)
					<li><label><input type="checkbox" checked name="related_products[]" value="{{ $related_product->related_product }}">{{ $related_product->product->title }}</label></li>
				@endforeach
			</ul>
		</div>
	</div>

	<div class="clearfix"></div>
	<br>
</div>