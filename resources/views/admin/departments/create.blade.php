@extends('admin.layouts.index')
@section('content')
@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#jstree').jstree({
            'core' : {
                'data' : {!! load_department(old('parent_id')) !!},
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
            @if ($errors->any())
            <ul class="alert alert-danger error_message">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['id' => 'add_department', 'route' => 'departments.store', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('department_name_ar', __('name_ar')) !!}
                    {!! Form::text('department_name_ar', old('department_name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('department_name_en', __('name_en')) !!}
                    {!! Form::text('department_name_en', old('department_name_en'), ['class' => 'form-control']) !!}
                </div>
                <div class="clearfix"></div>
                <div id="jstree"></div>
                <input type="hidden" name="parent_id" class="parent_id" value="{{ old('parent_id') }}">
                <div class="clearfix"></div>
                <div class="form-group">
                    {!! Form::label('department_description_ar', __('description_ar')) !!}
                    {!! Form::textarea('department_description_ar', old('department_description_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('department_description_en', __('description_en')) !!}
                    {!! Form::textarea('department_description_en', old('department_description_en'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('keywords', __('keywords')) !!}
                    {!! Form::textarea('keywords', old('keywords'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('icon', __('icon')) !!}
                    {!! Form::file('icon', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit(__('add'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>
<!--  -->
@endsection
