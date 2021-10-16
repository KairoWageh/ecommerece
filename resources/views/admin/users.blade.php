@extends('admin.layouts.index')
@section('content')
    <div class="box">
        <div class="box-header">
        	<h3 class="box-title">{{ $title }}</h3>
        </div>
            <div class="box-body">
                <button type="button" class="btn btn-info add_user" data-toggle="modal"  name="add_user">
                    <i class="fa fa-plus" style="color: #fff">{{__('add')}}</i>
                </button>
                {!! Form::open(['id' => 'form_data', 'url' => adminURL('admin/users/destroy/all'), 'method' => 'delete']) !!}
                <!-- {!! Form::hidden('_method', 'delete') !!} -->
                {{ $dataTable->table([
                	'class' => 'dataTable table ',
                	'id' => 'users_table'
                	], true) }}
                    {!! Form::close() !!}
            </div>
            <!-- </div>
        </div> -->
    </div>
    <div id="multipleDelete" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{__('admin.delete')}}</h4>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger">
                <div class="empty_record hidden">
                    <h4>{{__('admin.please_check_some_records')}}</h4>
                </div>
                <div class="not_empty_record hidden">
                    <h4>{{__('admin.ask_delete_item')}}<span class="record_count"></span> </h4>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="empty_record hidden">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('admin.close')}}</button>
            </div>
            <div class="not_empty_record hidden">
                <input type="submit" name="delete_all" value="{{__('admin.yes')}}" class="btn btn-danger delete_all">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('admin.no')}}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('admin.users._create')
    @include('admin.users._edit')
    @include('admin.users._delete')
@push('js')
{{ $dataTable->scripts() }}
<script>
    var users_table = $('#users_table');
    $(document).on('click', 'button.add_user',function(event) {
        $('.validation-errors').html('');
        $('#add_user_modal').modal('show');
    });
    // add user form submition
    $('#add_user_form').on('submit',function(event){
        event.preventDefault();
        // get form submitted data
        let formData = new FormData(this);
        $.ajax({
            url: "users",
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.user){
                    users_table.prepend('<tr id ="'+response.user.id+'">'+
                        '<td><input type="checkbox" class="item_checkbox" name="item[]" value="'+response.user.id+'"></td>'+
                        '<td class="text-center sorting_1">'+response.user.name+'</td>'+
                        '<td class=" text-center">'+response.user.email+'</td>'+
                        '<td class=" text-center">'+response.user.level+'</td>'+
                        '<td class=" text-center">'+response.user.created_at+'</td>'+
                        '<td class=" text-center">'+response.user.updated_at+'</td>'+
                        '<td class=" text-center edit_'+response.user.id+'">'+
                        '<td class=" text-center delete_'+response.user.id+'">'
                    );
                    var edit_btn = $('<button/>')
                        .attr('data-id', response.user.id)
                        .addClass('btn btn-info edit_user')
                        // .attr('onclick', 'edit_user('+response.admin.id+')')
                        .attr('type', 'button')
                        .html('<i class="fa fa-edit" style="color: #fff"></i>');
                    $('.edit_'+response.user.id).append(edit_btn);
                    var delete_btn = $('<button/>')
                        .attr('data-id', response.user.id)
                        .addClass('btn btn-danger delete_user')
                        // .attr('onclick', 'delete_user('+response.admin.id+')')
                        .attr('type', 'button')
                        .html('<i class="fa fa-trash"></i>');;
                    $('.delete_'+response.user.id).append(delete_btn);
                    toastr.success(response.message);
                    $('#add_user_modal').modal('hide');
                    document.getElementById('add_user_form').reset();
                }else{
                    toastr.error(response.message);
                }
            },
            error: function (xhr) {
                $('.validation-errors').html('');
                $.each(xhr.responseJSON.errors, function(key,value) {
                    $('.validation-errors').append('<p style="color: red">'+value+'</p');
                });
            },
        });
    });

    $(document).on('click', 'button.edit_user',function(event) {
        $('.validation-errors').html('');
        var user_id = parseInt($(this).attr("data-id"));
        var url = "{{url('admin/users/:user/edit')}}";
        url = url.replace(':user', user_id);
        $.ajax({
            url: url,
            type:"GET",
            data: {user_id: user_id},
            contentType: 'application/json; charset=utf-8',
            success:function(response){
                $('#user_id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_email').val(response.email);
                // show edit user modal
                $('#edit_user_modal').modal('show');
            }, error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                console.log('Error - ' + errorMessage);
            }
        });
    });
    // edit user form submition
    $('#edit_user_form').on('submit',function(event){
        event.preventDefault();
        // get form submitted data
        var user_id = $(".user_id_to_edit").attr("value");
        let formData = new FormData(this);
        var url = "{{url('admin/users/:user_id')}}";
        url = url.replace(":user_id", user_id);
        $.ajax({
            url: url,
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.user){
                    toastr.success(response.message);
                    $('#edit_user_modal').modal('hide');
                    // get tr by id and refresh
                    users_table.find('tr').each(function(){
                        if($(this).attr('id') == user_id){
                            // $(this).remove();
                            $(this).find('td').each (function(index, tr) {
                                if(index == 1){
                                    $(this).html(response.user.name);
                                }
                                if(index == 2){
                                    $(this).html(response.user.email);
                                }
                            });
                        }
                    });
                }else{
                    toastr.error(response.message);
                }
            },
            error: function (xhr) {
                $('.validation-errors').html('');
                $.each(xhr.responseJSON.errors, function(key,value) {
                    $('.validation-errors').append('<p style="color: red">'+value+'</p');
                });
            },
        });
    });

    $(document).on('click', 'button.delete_user',function(event) {
        var user_id = parseInt($(this).attr("data-id"));
        $('#delete_user_modal').modal('show');
        $(".user_id_to_delete").attr("value", user_id);
    });

    // confirm delete user
    $('.delete_user_confirm').click(function(){
        var user_id = $(".user_id_to_delete").attr("value");
        var url = "{{url('admin/users/:user')}}";
        url = url.replace(':user', user_id);
        $.ajax({
            url: url,
            type: "DELETE",
            data: {"_token": "{{ csrf_token() }}"},
            success:function(response){
                if(response.toast == 'success'){
                    toastr.success(response.message);
                }else if(response.toast == 'error'){
                    toastr.error(response.message);
                }
                $('#delete_user_modal').modal('hide');
                $('table#users_table tr#'+user_id).remove();
            },
        });
    });
</script>
@endpush

@endsection
