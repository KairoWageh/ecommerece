@extends('admin.layouts.index')
@section('content')
    <div class="box">
        <div class="box-header">
        	<h3 class="box-title">{{ $title }}</h3>
        </div>
            <div class="box-body">
                {!! Form::open(['id' => 'form_data', 'url' => adminURL('admin/countries/destroy/all'), 'method' => 'delete']) !!}
                <!-- {!! Form::hidden('_method', 'delete') !!} -->
                {{ $dataTable->table([
                	'class' => 'dataTable table ',
                	'id' => 'countries_table'
                	], true) }}
                    {!! Form::close() !!}
            </div>
           <!--  </div>
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

@push('js')
{{ $dataTable->scripts() }}
@endpush

    <script>
        var countries_table = $('#countries_table');

        $(document).on('click', 'button.add_admin',function(event) {
            // event.preventDefault();
            // document.getElementById('add_admin_form').reset();
            $('#add_admin_modal').modal('show');
        });

        // add admin form submition
        $('#add_admin_form').on('submit',function(event){
            event.preventDefault();
            // get form submitted data
            let formData = new FormData(this);
            $.ajax({
                url: "admin/admins",
                type:"POST",
                data: formData,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.admin){
                        // admins_table.append('<tr id ="'+response.admin.id+'">'+
                        //     '<td>'+response.admin.name+'</td>'+
                        //     '<td>'+response.admin.email+'</td>'+
                        //     // '<td>'+response.user.role+'</td>'+
                        //     '<td class="actions_'+response.admin.id+'">'
                        // );
                        // var edit_btn = $('<button/>')
                        //     .attr('data-id', response.admin.id)
                        //     .addClass('btn btn-info edit_admin')
                        //     .attr('onclick', 'edit_admin('+response.admin.id+')')
                        //     .attr('type', 'button')
                        //     .html('<i class="fa fa-edit" style="color: #fff"></i>');
                        // $('.actions_'+response.admin.id).append(edit_btn);
                        // var delete_btn = $('<button/>')
                        //     .attr('data-id', response.admin.id)
                        //     .addClass('btn btn-danger delete_admin')
                        //     .attr('onclick', 'delete_user('+response.admin.id+')')
                        //     .attr('type', 'button')
                        //     .html('<i class="fa fa-trash"></i>');;
                        // $('.actions_'+response.admin.id).append(delete_btn);
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


        $(document).on('click', 'button.edit_country',function(event) {
            var country_id = parseInt($(this).attr("data-id"));
            var url = "{{url('admin/countries/:country/edit')}}";
            url = url.replace(':country', country_id);
            $.ajax({
                url: url,
                type:"GET",
                data: {country_id: country_id},
                contentType: 'application/json; charset=utf-8',
                //dataType: 'json',
                success:function(response){

                    // $('#country_id').val(response.id);
                    // $('#edit_name').val(response.name);
                    // $('#edit_email').val(response.email);

                    // show edit admin modal
                    $('#edit_country_modal').modal('show');
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
                                    if(index == 2){
                                        $(this).html(response.admin.name);
                                    }
                                    if(index == 3){
                                        $(this).html(response.adminemail);
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
@endsection
