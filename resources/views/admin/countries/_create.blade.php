<!-- Add country modal start -->
<div class="modal fade" id="add_country_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('add')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class ="validation-errors"></div>
            {!! Form::open(["id"=>"add_country_form", "method"=>"POST", "enctype"=>"multipart/form-data"]) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('country_name_ar', __('name_ar')) !!}
                        {!! Form::text('country_name_ar', old('country_name_ar'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('country_name_en', __('name_en')) !!}
                        {!! Form::text('country_name_en', old('country_name_en'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('country_code', __('country_code')) !!}
                        {!! Form::text('country_code', old('country_code'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('country_iso_code', __('country_iso_code')) !!}
                        {!! Form::text('country_iso_code', old('country_iso_code'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('country_currency', __('country_currency')) !!}
                        {!! Form::text('country_currency', old('country_currency'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('country_flag', __('country_flag')) !!}
                        {!! Form::file('country_flag', ['class' => 'form-control']) !!}
                    </div>
                </div>
{{--                {!! Form::submit(__('admin.add'), ['class' => 'btn btn-primary']) !!}--}}
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('add')}}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Add country modal end -->
