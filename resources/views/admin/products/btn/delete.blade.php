<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_admin"><i class ="fa fa-trash"></i></button>
<!-- Modal -->
<div id="delete_admin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{__('delete')}}</h4>
      </div>
      {!! Form::open(['route' => ['products.destroy', $id], 'method' => 'delete']) !!}
      <div class="modal-body">
      	<div class="alert alert-danger">
	        <h4>
	        	{{__('delete_record')}}
	        </h4>
	    </div>
      </div>
      <div class="modal-footer">
        {!! Form::submit(__('delete'), ['class' => 'btn btn-danger']) !!}
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('close') }}</button>
      </div>
      {!! Form::close() !!}
    </div>

  </div>
</div>
