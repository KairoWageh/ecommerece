@extends('admin.layouts.index')
@section('content')
@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#jstree').jstree({
            'core' : {
                'data' : {!! load_department(old('department_id')) !!},
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
            //name.push(data.instance.get_node(data.selected[i]).text);
        }
        // $('#form_delete_department').attr('action', '{{adminURL('departments')}}/'+r.join(', '));
        // $('.parent_id').val(r.join(', '));
        if(r.join(', ') != ''){
            $('.department_id').val(r.join(', '));
        }
   });
</script>
@endpush
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['route' => 'sizes.store', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('name_ar', __('admin.name_ar')) !!}
                    {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name_en', __('admin.name_en')) !!}
                    {!! Form::text('name_en', old('name_en'), ['class' => 'form-control']) !!}
                </div>
                <input type="hidden" name="department_id" class="department_id" value="{{ old('department_id') }}">
                <div id="jstree"></div>
                <div class="form-group">
                    {!! Form::label('is_public', __('admin.is_public')) !!}
                    {!! Form::select('is_public', ['yes' => __('admin.yes'), 'no' => __('admin.no')], old('is_public'), ['class' => 'form-control']) !!}
                </div>
                <!-- <div class="form-group">
                    {!! Form::label('department_id', __('admin.department')) !!}
                    {!! Form::select('department_id', $departments, old('department_id'), ['class' => 'form-control']) !!}
                </div> -->
                {!! Form::submit(__('admin.add'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>
@endsection
