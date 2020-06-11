@extends('admin.index')
@section('content')
    <div class="box">
        <div class="box-header">
        	<h3 class="box-title">{{ $title }}</h3>
        </div>
            <div class="box-body">
                {!! Form::open(['id' => 'form_data', 'url' => adminURL('admin/cities/destroy/all'), 'method' => 'delete']) !!}
                <!-- {!! Form::hidden('_method', 'delete') !!} -->
                {{ $dataTable->table([
                	'class' => 'dataTable table '
                	], true) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="multipleDelete" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{__('admin.delete')}}</h4>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger">
                <div class="empty_record hidden">
                    <h4>{{__('admin.please_check_some_records')}}</h4>    
                </div>
                <div class="not_empty_record hidden">
                    <h4>{{__('admin.ask_delete_item')}}<span class="record_count"></span> </h4>
                </div>
                
            </div>
          </div>
          <div class="modal-footer">
            <div class="empty_record hidden">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('admin.close')}}</button>
            </div>
            <div class="not_empty_record hidden">
                <input type="submit" name="delete_all" value="{{__('admin.yes')}}" class="btn btn-danger delete_all">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('admin.no')}}</button>
            </div>
          </div>
        </div>

      </div>
    </div>

@push('js')
{{ $dataTable->scripts() }}
@endpush
@endsection