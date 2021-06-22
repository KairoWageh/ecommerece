<!-- Add admin modal start -->
<div class="modal fade" id="add_admin_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('add_admin')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class ="validation-errors"></div>
            <form id="add_admin_form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name_en">{{__('name')}}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="{{__('name')}}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">{{__('email')}}</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="{{__('email')}}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">{{__('password')}}</label>
                        <input type="password" name="password"  class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{__('password')}}">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">{{__('password_confirmation')}}</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="{{__('password_confirmation')}}">
                        @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="role">{{__('role')}}</label>--}}
{{--                        <select name="role" class="form-control @error('admin_role') is-invalid @enderror">--}}
{{--                            <option value="">....</option>--}}
{{--                            @foreach($roles as $role)--}}
{{--                                <option value="{{$role}}">{{$role}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}

{{--                        @error('admin_role')--}}
{{--                        <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('add')}}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add admin modal end -->
