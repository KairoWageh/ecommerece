<div id="product_info" class="tab-pane fade in active">
	<h3>{{__('product_info')}}</h3>
 	<div class="form-group">
 		{!! Form::label('title', __('product_title')) !!}
 		{!! Form::text('title', $product->title, ['class' => 'form-control', 'placeholder' => __('product_title')]) !!}
 	</div>
 	<div class="form-group">
 		{!! Form::label('content', __('product_content')) !!}
 		{!! Form::textarea('content', $product->content, ['class' => 'form-control', 'placeholder' => __('product_content')]) !!}
 	</div>
</div>
