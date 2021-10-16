<div id="product_info" class="tab-pane fade in active">
    <div class="tab_title">
        <h3>{{__('product_info')}}</h3>
    </div>
    <div class="clearfix"></div>
    @if(isset($product))
 	<div class="form-group">
 		{!! Form::label('title', __('product_title')) !!}
 		{!! Form::text('title', $product->title, ['class' => 'form-control title', 'placeholder' => __('product_title')]) !!}
 	</div>
 	<div class="form-group">
 		{!! Form::label('content', __('product_content')) !!}
 		{!! Form::textarea('content', $product->content, ['class' => 'form-control content', 'placeholder' => __('product_content')]) !!}
 	</div>
    @else
        <div class="form-group">
            {!! Form::label('title', __('product_title')) !!}
            {!! Form::text('title', '', ['class' => 'form-control title', 'placeholder' => __('product_title')]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('content', __('product_content')) !!}
            {!! Form::textarea('content', '', ['class' => 'form-control content', 'placeholder' => __('product_content')]) !!}
        </div>
    @endif
</div>

