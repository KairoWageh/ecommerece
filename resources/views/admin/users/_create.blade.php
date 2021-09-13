<!-- Add user modal start -->
<div class="modal fade" id="add_user_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('add')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class ="validation-errors"></div>
            {!! Form::open(["id"=>"add_user_form", "method"=>"POST", "enctype"=>"multipart/form-data"]) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('name', __('name')) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', __('email')) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', __('password')) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('level', __('level')) !!}
                     {!! Form::select('level',  $user_levels, old('level'), ['class' => 'form-control', 'placeholder' => '..............']) !!}
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('add')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Add user modal end -->
