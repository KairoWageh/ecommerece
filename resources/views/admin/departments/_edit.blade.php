@extends('admin.layouts.index')
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


<!-- Edit department modal start -->
{{--<div class="modal fade" id="edit_department_modal">--}}
{{--    <div class="modal-dialog">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header bg-primary">--}}
{{--                <h4 class="modal-title">{{__('edit')}}</h4>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class ="validation-errors"></div>--}}
{{--            <form id="edit_department_form" method="POST" enctype="multipart/form-data">--}}
{{--                {{ csrf_field() }}--}}
{{--                {{ method_field('PATCH') }}--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="hidden" name="department_id" class="form-control department_id_to_edit" id="department_id" value="">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="department_name_ar">{{__('name_ar')}}</label>--}}
{{--                        <input type="text" name="department_name_ar" class="form-control @error('department_name_ar') is-invalid @enderror" id="department_name_ar" placeholder="{{__('name_ar')}}">--}}
{{--                        @error('department_name_ar')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="department_name_en">{{__('name_en')}}</label>--}}
{{--                        <input type="text" name="department_name_en" class="form-control @error('department_name_en') is-invalid @enderror" id="department_name_en" placeholder="{{__('name_en')}}">--}}
{{--                        @error('department_name_en')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="department_description_ar">{{__('description_ar')}}</label>--}}
{{--                        <input type="text" name="department_description_ar" class="form-control @error('department_description_ar') is-invalid @enderror" id="department_description_ar" placeholder="{{__('description_ar')}}">--}}
{{--                        @error('department_description_ar')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="department_description_en">{{__('description_en')}}</label>--}}
{{--                        <input type="text" name="department_description_en" class="form-control @error('department_description_en') is-invalid @enderror" id="department_description_en" placeholder="{{__('description_en')}}">--}}
{{--                        @error('department_description_en')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="keywords">{{__('keywords')}}</label>--}}
{{--                        <input type="text" name="keywords" class="form-control @error('keywords') is-invalid @enderror" id="keywords" placeholder="{{__('keywords')}}">--}}
{{--                        @error('keywords')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <div class="modal-footer justify-content-between">--}}
{{--                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>--}}
{{--                    <button type="submit" class="btn btn-primary">{{__('edit')}}</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--        <!-- /.modal-content -->--}}
{{--    </div>--}}
{{--    <!-- /.modal-dialog -->--}}
{{--</div>--}}
<!-- Edit department modal end -->
@endpush
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['route' => ['departments.update', $department->id], 'method' => 'put', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('department_name_ar', __('name_ar')) !!}
                    {!! Form::text('department_name_ar', $department->department_name_ar, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('department_name_en', __('name_en')) !!}
                    {!! Form::text('department_name_en', $department->department_name_en, ['class' => 'form-control']) !!}
                </div>
                <div class="clearfix"></div>
                <div id="jstree"></div>
                <input type="hidden" name="parent_id" class="parent_id" value="{{ $department->parent_id }}">
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
                    @if(!empty($department->icon) and Storage::has($department->icon))
                        <img src="{{Storage::url($department->icon)}}" width="30px" height="30px">
                    @endif
                </div>
                {!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>
<!--  -->
@endsection
