<div id="product_info" class="tab-pane fade in active">
    <div class ="validation-errors"></div>
    <div class="tab_title">
        <h3>{{__('product_info')}}</h3>
    </div>
    <div class="clearfix"></div>
    {!! Form::open() !!}
    @if(isset($product))
 	<div class="form-group">
 		{!! Form::label('title', __('product_title')) !!}
 		{!! Form::text('title', $product->title, ['class' => 'form-control title', 'placeholder' => __('product_title')]) !!}
 	</div>
 	<div class="form-group">
 		{!! Form::label('content', __('product_content')) !!}
 		{!! Form::textarea('content', $product->content, ['class' => 'form-control content', 'placeholder' => __('product_content')]) !!}
 	</div>
        <a href="#" class="btn btn-primary edit_product_info">{{__('save')}}<i class="fa fa-floppy-o"></i></a>
    @else
        <div class="form-group">
            {!! Form::label('title', __('product_title')) !!}
            {!! Form::text('title', '', ['class' => 'form-control title', 'placeholder' => __('product_title')]) !!}
        </div>
{{--    product department--}}
        {!! Form::label(__('department')) !!}
        <div id="jstree"></div>
        <div class="form-group">
            {!! Form::label('content', __('product_content')) !!}
            {!! Form::textarea('content', '', ['class' => 'form-control content', 'placeholder' => __('product_content')]) !!}
        </div>
        <a href="#" class="btn btn-primary save_product_info">{{__('save')}}<i class="fa fa-floppy-o"></i></a>
    @endif

    {!! Form::close() !!}
</div>


