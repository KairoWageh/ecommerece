@extends('admin.layouts.index')
@section('content')
    <div class="box">
        <div class="box-header">
        	<h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <button type="button" class="btn btn-info add_admin" data-toggle="modal"  name="add_admin">
                <i class="fa fa-plus" style="color: #fff">{{__('add')}}</i>
            </button>
            {!! Form::open(['id' => 'form_data', 'url' => adminURL('admin/admins/destroy/all'), 'method' => 'delete']) !!}
            <!-- {!! Form::hidden('_method', 'delete') !!} -->
            {{ $dataTable->table([
            	'class' => 'dataTable table ',
            	'id' => 'admins_table'
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
            <h4 class="modal-title">{{__('delete')}}</h4>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger">
                <div class="empty_record hidden">
                    <h4>{{__('please_check_some_records')}}</h4>
                </div>
                <div class="not_empty_record hidden">
                    <h4>{{__('ask_delete_item')}}<span class="record_count"></span> </h4>
                </div>

            </div>
          </div>
          <div class="modal-footer">
            <div class="empty_record hidden">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
            </div>
            <div class="not_empty_record hidden">
                <input type="submit" name="delete_all" value="{{__('yes')}}" class="btn btn-danger delete_all">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('no')}}</button>
            </div>
          </div>
        </div>

      </div>
    </div>

    @include('admin.admins._create')
    @include('admin.admins._edit')
    @include('admin.admins._delete')
@push('js')

{{$dataTable->scripts()}}
<script>
    var admins_table = $('#admins_table');

    $(document).on('click', 'button.add_admin',function(event) {
        $('.validation-errors').html('');
        $('#add_admin_modal').modal('show');
    });

    // add admin form submition
    $('#add_admin_form').on('submit',function(event){
        event.preventDefault();
        // get form submitted data
        let formData = new FormData(this);
        $.ajax({
            url: "admins",
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.admin){
                    admins_table.prepend('<tr id ="'+response.admin.id+'">'+
                        '<td><input type="checkbox" class="item_checkbox" name="item[]" value="'+response.admin.id+'"></td>'+
                        '<td class="text-center sorting_1">'+response.admin.name+'</td>'+
                        '<td class=" text-center">'+response.admin.email+'</td>'+
                        '<td class=" text-center">'+response.admin.created_at+'</td>'+
                        '<td class=" text-center">'+response.admin.updated_at+'</td>'+
                        '<td class=" text-center edit_'+response.admin.id+'">'+
                        '<td class=" text-center delete_'+response.admin.id+'">'
                    );
                    var edit_btn = $('<button/>')
                        .attr('data-id', response.admin.id)
                        .addClass('btn btn-info edit_admin')
                        // .attr('onclick', 'edit_user('+response.admin.id+')')
                        .attr('type', 'button')
                        .html('<i class="fa fa-edit" style="color: #fff"></i>');
                    $('.edit_'+response.admin.id).append(edit_btn);
                    var delete_btn = $('<button/>')
                        .attr('data-id', response.admin.id)
                        .addClass('btn btn-danger delete_admin')
                        // .attr('onclick', 'delete_user('+response.admin.id+')')
                        .attr('type', 'button')
                        .html('<i class="fa fa-trash"></i>');;
                    $('.delete_'+response.admin.id).append(delete_btn);
                    toastr.success(response.message);
                    $('#add_admin_modal').modal('hide');
                    document.getElementById('add_admin_form').reset();
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


    $(document).on('click', 'button.edit_admin',function(event) {
        $('.validation-errors').html('');
        var admin_id = parseInt($(this).attr("data-id"));
        var url = "{{url('admin/admins/:admin/edit')}}";
        url = url.replace(':admin', admin_id);
        $.ajax({
            url: url,
            type:"GET",
            data: {admin_id: admin_id},
            contentType: 'application/json; charset=utf-8',
            //dataType: 'json',
            success:function(response){

                $('#admin_id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_email').val(response.email);

                // show edit admin modal
                $('#edit_admin_modal').modal('show');
            }, error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                console.log('Error - ' + errorMessage);
            }
        });
    });

    // edit admin form submition
    $('#edit_admin_form').on('submit',function(event){
        event.preventDefault();
        // get form submitted data
        var admin_id = $(".admin_id_to_edit").attr("value");
        let formData = new FormData(this);
        var url = "{{url('admin/admins/:admin_id')}}";
        url = url.replace(":admin_id", admin_id);
        $.ajax({
            url: url,
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success:function(response){
                if(response.admin){
                    toastr.success(response.message);
                    $('#edit_admin_modal').modal('hide');
                    // get tr by id and refresh
                    admins_table.find('tr').each(function(){
                        if($(this).attr('id') == admin_id){
                            // $(this).remove();
                            $(this).find('td').each (function(index, tr) {
                                console.log('index:::'+index);
                                if(index == 1){
                                    $(this).html(response.admin.name);
                                }
                                if(index == 2){
                                    $(this).html(response.admin.email);
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

    $(document).on('click', 'button.delete_admin',function(event) {
        var admin_id = parseInt($(this).attr("data-id"));
        $('#delete_admin_modal').modal('show');
        $(".admin_id_to_delete").attr("value", admin_id);
    });

    // confirm delete admin
    $('.delete_admin_confirm').click(function(){
        var admin_id = $(".admin_id_to_delete").attr("value");
        var url = "{{url('admin/admins/:admin')}}";
        url = url.replace(':admin', admin_id);
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
                $('#delete_admin_modal').modal('hide');
                $('table#admins_table tr#'+admin_id).remove();
            },
        });
    });
</script>
@endpush


@endsection
