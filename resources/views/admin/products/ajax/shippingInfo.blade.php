<div class="col-md-6">
	<div class="form-group">
	    {!! Form::label('sizes', __('admin.size_id'), ['class' => 'col-md-3']) !!}
	    <div class="col-md-9">
	    	{!! Form::select('sizes',  $sizes,  ['class' => 'form-control', 'placeholder' => __('admin.size_id')]) !!}	
	    </div>
	</div>
	<div class="clearfix"></div>
	<div class="form-group">
	    {!! Form::label('size', __('admin.size'), ['class' => 'col-md-3']) !!}
	    <div class="col-md-9">
	    	{!! Form::text('size', '',  ['class' => 'form-control', 'placeholder' => __('admin.size')]) !!}	
	    </div>
	</div>
</div>



<div class="col-md-6">
	<div class="form-group">
	    {!! Form::label('weight_id', __('admin.weight_id'), ['class' => 'col-md-3']) !!}
	    <div class="col-md-9">
	    	{!! Form::select('weight_id',  $weights,  ['class' => 'form-control', 'placeholder' => __('admin.weight_id')]) !!}	
	    </div>
	</div>
	<div class="clearfix"></div>
	<div class="form-group">
	    {!! Form::label('weight', __('admin.weight'), ['class' => 'col-md-3']) !!}
	    <div class="col-md-9">
	    	{!! Form::text('weight', '',  ['class' => 'form-control', 'placeholder' => __('admin.weight')]) !!}	
	    </div>
	</div>
</div>
<div class="clearfix"></div>
