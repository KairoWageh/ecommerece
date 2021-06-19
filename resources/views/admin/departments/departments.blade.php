@extends('admin.index')
@section('content')
@push('js')
<!-- Modal -->
<div id="delete_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{__('admin.delete')}}</h4>
      </div>
      {!! Form::open(['route' => ['departments.destroy', 1], 'method' => 'delete', 'id' => 'form_delete_department']) !!}
      <div class="modal-body">
        <div class="alert alert-danger">
          <h4>
            {{__('admin.delete_record')}}
          </h4>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('admin.close') }}</button>
        {!! Form::submit(__('admin.delete'), ['class' => 'btn btn-danger']) !!}
        
      </div>
      {!! Form::close() !!}
    </div>

  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#jstree').jstree({
            'core' : {
                'data' : {!! load_department() !!},
                "themes" : {
                  "variant" : "large"
                }
              },
              "checkbox" : {
                  "keep_selected_style" : true
              },
              "plugins" : ["wholerow"]
        });
    });
    $('#jstree').on('changed.jstree', function(e, data){
        var i, j, r = [];
        var name = [];
        for(i=0, j=data.selected.length; i<j; i++){
            r.push(data.instance.get_node(data.selected[i]).id);
            name.push(data.instance.get_node(data.selected[i]).text);
        }
        $('#form_delete_department').attr('action', '{{adminURL('departments')}}/'+r.join(', '));
        $('.parent_id').val(r.join(', '));
        if(r.join(', ') != ''){
          $('.show_btn_control').removeClass('hidden');
          $('.edit_department').attr('href', '{{ adminURL('departments') }}/'+r.join(', ')+'/edit');
        }else{
          $('.show_btn_control').addClass('hidden');
        }
   });
</script>
@endpush
    <div class="box">
        <div class="box-header">
        	<h3 class="box-title">{{ $title }}</h3>
        </div>
            <div class="box-body">
              <a href="" class="btn btn-info edit_department show_btn_control hidden"><i class="fa fa-edit"></i>{{__('admin.edit')}}</a>
              <a href="" class="btn btn-danger delete_department show_btn_control hidden" data-toggle="modal" data-target="#delete_modal"><i class="fa fa-trash"></i>{{__('admin.delete')}}</a>
                <div id="jstree"></div>
                
                <input type="hidden" name="parent_id" class="parent_id" value="">
                </div>
            </div>
         </div>
    </div>


@endsection