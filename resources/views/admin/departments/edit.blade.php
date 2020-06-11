@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#jstree').jstree({
            'core' : {
                'data' : {!! load_department($department->parent_id) !!},
                "themes" : {
                  "variant" : "large"
                }
            },
            "checkbox" : {
                "keep_selected_style" : false
            },
            "plugins" : ["wholerow"]
        });
    });
   $('#jstree').on('changed.jstree', function(e, data){
        var i, j, r = [];
        for(i=0, j=data.selected.length; i<j; i++){
            r.push(data.instance.get_node(data.selected[i]).id);
        }
        $('.parent_id').val(r.join(', '));
   });
</script>
@endpush
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['route' => ['departments.update', $department->id], 'method' => 'put', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('department_name_ar', __('admin.name_ar')) !!}
                    {!! Form::text('department_name_ar', $department->department_name_ar, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('department_name_en', __('admin.name_en')) !!}
                    {!! Form::text('department_name_en', $department->department_name_en, ['class' => 'form-control']) !!}
                </div>
                <div class="clearfix"></div>
                <div id="jstree"></div>
                <input type="hidden" name="parent_id" class="parent_id" value="{{ $department->parent_id }}">
                <div class="clearfix"></div>
                <div class="form-group">
                    {!! Form::label('description', __('admin.description')) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('keywords', __('admin.keywords')) !!}
                    {!! Form::textarea('keywords', old('keywords'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('icon', __('admin.icon')) !!}
                    {!! Form::file('icon', ['class' => 'form-control']) !!}
                    @if(!empty($department->icon) and Storage::has($department->icon))
                        <img src="{{Storage::url($department->icon)}}" width="30px" height="30px">
                    @endif
                </div>
                {!! Form::submit(__('admin.save'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>
<!--  -->
@endsection
