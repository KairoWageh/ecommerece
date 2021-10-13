@extends('admin.layouts.index')
@section('content')
    <div class="box">
        <div class="box-header">
        	<h3 class="box-title">{{ $title }}</h3>
        </div>
            <div class="box-body">
                <button type="button" class="btn btn-info add_tradeMark" data-toggle="modal"  name="add_tradeMark">
                    <i class="fa fa-plus" style="color: #fff">{{__('add')}}</i>
                </button>
                {!! Form::open(['id' => 'form_data', 'url' => adminURL('admin/trademarks/destroy/all'), 'method' => 'delete']) !!}
                <!-- {!! Form::hidden('_method', 'delete') !!} -->
                {{ $dataTable->table([
                	'class' => 'dataTable table ',
                	'id' => 'tradeMarks_table'
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
@include('admin.trademarks._create')
@push('js')
{{ $dataTable->scripts() }}
@endpush
    <script>
        var tradeMarks_table = $('#tradeMarks_table');
        $(document).on('click', 'button.add_tradeMark',function(event) {
            $('.validation-errors').html('');
            $('#add_tradeMark_modal').modal('show');
        });

        // add tradeMark form submition
        $('#add_tradeMark_form').on('submit',function(event){
            event.preventDefault();
            // get form submitted data
            let formData = new FormData(this);
            $.ajax({
                url: "trademarks",
                type:"POST",
                data: formData,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.tradeMark){
                        tradeMarks_table.prepend('<tr id ="'+response.tradeMark.id+'">'+
                            '<td><input type="checkbox" class="item_checkbox" name="item[]" value="'+response.tradeMark.id+'"></td>'+
                            '<td class="text-center sorting_1">'+response.tradeMark.name_ar+'</td>'+
                            '<td class=" text-center">'+response.tradeMark.name_en+'</td>'+
                            '<td class=" text-center">'+response.tradeMark.created_at+'</td>'+
                            '<td class=" text-center">'+response.tradeMark.updated_at+'</td>'+
                            '<td class=" text-center edit_'+response.tradeMark.id+'">'+
                            '<td class=" text-center delete_'+response.tradeMark.id+'">'
                        );
                        var edit_btn = $('<button/>')
                            .attr('data-id', response.tradeMark.id)
                            .addClass('btn btn-info edit_tradeMark')
                            // .attr('onclick', 'edit_user('+response.admin.id+')')
                            .attr('type', 'button')
                            .html('<i class="fa fa-edit" style="color: #fff"></i>');
                        $('.edit_'+response.tradeMark.id).append(edit_btn);
                        var delete_btn = $('<button/>')
                            .attr('data-id', response.tradeMark.id)
                            .addClass('btn btn-danger delete_tradeMark')
                            // .attr('onclick', 'delete_user('+response.admin.id+')')
                            .attr('type', 'button')
                            .html('<i class="fa fa-trash"></i>');;
                        $('.delete_'+response.tradeMark.id).append(delete_btn);
                        toastr.success(response.message);
                        $('#add_tradeMark_modal').modal('hide');
                        document.getElementById('add_tradeMark_form').reset();
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

        $(document).on('click', 'button.edit_tradeMark',function(event) {
            $('.validation-errors').html('');
            var tradeMark_id = parseInt($(this).attr("data-id"));
            var url = "{{url('admin/trademarks/:tradeMark/edit')}}";
            url = url.replace(':tradeMark', tradeMark_id);
            $.ajax({
                url: url,
                type:"GET",
                data: {tradeMark_id: tradeMark_id},
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
        // edit tradeMark form submition
        $('#edit_tradeMark_form').on('submit',function(event){
            event.preventDefault();
            // get form submitted data
            var tradeMark_id = $(".tradeMark_id_to_edit").attr("value");
            let formData = new FormData(this);
            var url = "{{url('admin/trademarks/:tradeMark_id')}}";
            url = url.replace(":tradeMark_id", tradeMark_id);
            $.ajax({
                url: url,
                type:"POST",
                data: formData,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.tradeMark){
                        toastr.success(response.message);
                        $('#edit_tradeMark_modal').modal('hide');
                        // get tr by id and refresh
                        users_table.find('tr').each(function(){
                            if($(this).attr('id') == tradeMark_id){
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

        $(document).on('click', 'button.delete_tradeMark',function(event) {
            var tradeMark_id = parseInt($(this).attr("data-id"));
            $('#delete_tradeMark_modal').modal('show');
            $(".tradeMark_id_to_delete").attr("value", tradeMark_id);
        });

        // confirm delete tradeMark
        $('.delete_tradeMark_confirm').click(function(){
            var tradeMark_id = $(".tradeMark_id_to_delete").attr("value");
            var url = "{{url('admin/trademarks/:tradeMark')}}";
            url = url.replace(':tradeMark', tradeMark_id);
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
                    $('#delete_tradeMark_modal').modal('hide');
                    $('table#tradeMarks_table tr#'+tradeMark_id).remove();
                },
            });
        });
    </script>
@endsection
