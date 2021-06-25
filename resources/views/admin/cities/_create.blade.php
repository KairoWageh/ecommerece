<!-- Add city modal start -->
<div class="modal fade" id="add_city_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('add_city')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class ="validation-errors"></div>
            {!! Form::open(["id"=>"add_city_form", "method"=>"POST", "enctype"=>"multipart/form-data"]) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('city_name_ar', __('admin.name_ar')) !!}
                        {!! Form::text('city_name_ar', old('city_name_ar'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('city_name_en', __('admin.name_en')) !!}
                        {!! Form::text('city_name_en', old('city_name_en'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('country_id', __('admin.country')) !!}
                        {!! Form::select('country_id', $countries, null, ['class' => 'form-control']) !!}
                    </div>
{{--                {!! Form::submit(__('admin.add'), ['class' => 'btn btn-primary']) !!}--}}
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('add')}}</button>
                </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add city modal end -->
