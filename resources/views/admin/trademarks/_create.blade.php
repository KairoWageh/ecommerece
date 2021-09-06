<!-- Add tradeMark modal start -->
<div class="modal fade" id="add_tradeMark_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('add')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class ="validation-errors"></div>
            {!! Form::open(["id"=>"add_tradeMark_form", "method"=>"POST", "enctype"=>"multipart/form-data"]) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('name_ar', __('name_ar')) !!}
                        {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name_en', __('name_en')) !!}
                        {!! Form::text('name_en', old('name_en'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                    {!! Form::label('trademarkIcon', __('trademarkIcon')) !!}
                    {!! Form::file('trademarkIcon', ['class' => 'form-control']) !!}
                </div>
{{--                {!! Form::submit(__('admin.add'), ['class' => 'btn btn-primary']) !!}--}}
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('add')}}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Add tradeMark modal end -->
