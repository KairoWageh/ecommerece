<!-- Edit user modal start -->
<div class="modal fade" id="edit_user_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('edit_user')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class ="validation-errors"></div>
            <form id="edit_user_form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="user_id" class="form-control user_id_to_edit" id="user_id" value="">
                    </div>
                    <div class="form-group">
                        <label for="edit_name">{{__('name')}}</label>
                        <input type="text" name="edit_name" class="form-control @error('edit_name') is-invalid @enderror" id="edit_name" placeholder="{{__('name')}}">
                        @error('edit_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                     <div class="form-group">
                        <label for="edit_email">{{__('email')}}</label>
                        <input type="email" name="edit_email" class="form-control" id="edit_email" placeholder="{{__('email')}}">
                        @error('edit_email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                     </div>
                    <div class="form-group">
                        <label for="edit_password">{{__('password')}}</label>
                        <input type="password" name="edit_password" class="form-control" id="edit_password" placeholder="{{__('password')}}">
                        @error('edit_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('edit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit user modal end -->
