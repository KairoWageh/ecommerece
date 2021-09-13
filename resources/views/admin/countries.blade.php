@extends('admin.layouts.index')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <button type="button" class="btn btn-info add_country" data-toggle="modal"  name="add_country">
                <i class="fa fa-plus" style="color: #fff">{{__('add')}}</i>
            </button>
        {!! Form::open(['id' => 'form_data', 'url' => adminURL('admin/countries/destroy/all'), 'method' => 'delete']) !!}
        <!-- {!! Form::hidden('_method', 'delete') !!} -->
            {{ $dataTable->table([
            	'class' => 'dataTable table ',
            	'id' => 'countries_table'
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
    @include('admin.countries._create')
    @include('admin.countries._edit')
    @include('admin.countries._delete')
@push('js')
{{ $dataTable->scripts() }}
@endpush
    <script>
        var countries_table = $('#countries_table');
        $(document).on('click', 'button.add_country',function(event) {
            $('#add_country_modal').modal('show');
        });
        // add country form submition
        $('#add_country_form').on('submit',function(event){
            event.preventDefault();
            // get form submitted data
            let formData = new FormData(this);
            $.ajax({
                url: "countries",
                type:"POST",
                data: formData,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.country){
                        countries_table.append('<tr id ="'+response.country.id+'">'+
                            '<td><input type="checkbox" class="item_checkbox" name="item[]" value="'+response.country.id+'"></td>'+
                            '<td>'+response.country.country_name_ar+'</td>'+
                            '<td>'+response.country.country_name_en+'</td>'+
                            '<td>'+response.country.country_code+'</td>'+
                            '<td>'+response.country.country_iso_code+'</td>'+
                            '<td class=" text-center">'+response.country.created_at+'</td>'+
                            '<td class=" text-center">'+response.country.updated_at+'</td>'+
                            '<td class=" text-center edit_'+response.country.id+'">'+
                            '<td class=" text-center delete_'+response.country.id+'">'
                        );
                        var edit_btn = $('<button/>')
                            .attr('data-id', response.country.id)
                            .addClass('btn btn-info edit_country')
                            .attr('onclick', 'edit_country('+response.country.id+')')
                            .attr('type', 'button')
                            .html('<i class="fa fa-edit" style="color: #fff"></i>');
                        $('.edit_'+response.country.id).append(edit_btn);
                        var delete_btn = $('<button/>')
                            .attr('data-id', response.country.id)
                            .addClass('btn btn-danger delete_country')
                            .attr('onclick', 'delete_country('+response.country.id+')')
                            .attr('type', 'button')
                            .html('<i class="fa fa-trash"></i>');;
                        $('.delete_'+response.country.id).append(delete_btn);
                        toastr.success(response.message);
                        $('#add_country_modal').modal('hide');
                        document.getElementById('add_country_form').reset();
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
                    $('#country_id').val(response.id);
                    $('#edit_country_name_ar').val(response.country_name_ar);
                    $('#edit_country_name_en').val(response.country_name_en);
                    $('#edit_country_code').val(response.country_code);
                    $('#edit_country_iso_code').val(response.country_iso_code);
                    $('#edit_country_currency').val(response.country_currency);
                    // show edit admin modal
                    $('#edit_country_modal').modal('show');
                }, error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    console.log('Error - ' + errorMessage);
                }
            });
        });

        // edit country form submition
        $('#edit_country_form').on('submit',function(event){
            event.preventDefault();

            // get form submitted data
            var country_id = $(".country_id_to_edit").attr("value");
            let formData = new FormData(this);

            var url = "{{url('admin/countries/:country_id')}}";
            url = url.replace(":country_id", country_id);

            $.ajax({
                url: url,
                type:"POST",
                data: formData,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.country){
                        toastr.success(response.message);
                        $('#edit_country_modal').modal('hide');
                        // get tr by id and refresh
                        countries_table.find('tr').each(function(){
                            if($(this).attr('id') == country_id){
                                $(this).find('td').each (function(index, tr) {
                                    if(index == 1){
                                        $(this).html(response.country.name_ar);
                                    }
                                    if(index == 2){
                                        $(this).html(response.country.name_en);
                                    }
                                    if(index == 3){
                                        $(this).html(response.country.code);
                                    }
                                    if(index == 4){
                                        $(this).html(response.country.iso_code);
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

        $(document).on('click', 'button.delete_country',function(event) {
            var country_id = parseInt($(this).attr("data-id"));
            $('#delete_country_modal').modal('show');
            $(".country_id_to_delete").attr("value", country_id);
        });

        // confirm delete country
        $('.delete_country_confirm').click(function(){
            var country_id = $(".country_id_to_delete").attr("value");
            var url = "{{url('admin/countries/:country')}}";
            console.log('url:::::::'+url);
            url = url.replace(':country', country_id);
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
                    $('#delete_country_modal').modal('hide');
                    $('table#countries_table tr#'+country_id).remove();
                },
            });
        });
    </script>
@endsection
