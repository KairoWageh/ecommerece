<!-- Edit city modal start -->
<div class="modal fade" id="edit_city_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('edit')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class ="validation-errors"></div>
            {!! Form::open(["id"=>"edit_city_form", "method"=>"POST", "enctype"=>"multipart/form-data"]) !!}
            {{ method_field('PATCH') }}
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="city_id" class="form-control city_id_to_edit" id="city_id" value="">
                </div>
                <div class="form-group">
                    {!! Form::label('edit_city_name_ar', __('name_ar')) !!}
                    {!! Form::text('edit_city_name_ar', old('edit_city_name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('edit_city_name_en', __('name_en')) !!}
                    {!! Form::text('edit_city_name_en', old('edit_city_name_en'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('edit_country_id', __('country')) !!}
                    {!! Form::select('edit_country_id', $countries, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('edit')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit city modal end -->
