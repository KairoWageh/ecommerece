@extends('admin.layouts.index')
@section('content')
    <div class="box">
        <div class="box-header">
        	<h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <button type="button" class="btn btn-info add_city" data-toggle="modal"  name="add_city">
                <i class="fa fa-plus" style="color: #fff">{{__('add')}}</i>
            </button>
            {!! Form::open(['id' => 'form_data', 'url' => adminURL('admin/cities/destroy/all'), 'method' => 'delete']) !!}
            <!-- {!! Form::hidden('_method', 'delete') !!} -->
            {{ $dataTable->table([
            	'class' => 'dataTable table ',
            	'id' => 'cities_table'
            	], true) }}
                {!! Form::close() !!}
            </div>
    </div>
        <!-- </div>
    </div> -->

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
    @include('admin.cities._create')
    @include('admin.cities._edit')
    @include('admin.cities._delete')
@push('js')
{{ $dataTable->scripts() }}
@endpush
    <script>
        var cities_table = $('#cities_table');
        $(document).on('click', 'button.add_city',function(event) {
            $('.validation-errors').html('');
            $('#add_city_modal').modal('show');
        });
        // add city form submition
        $('#add_city_form').on('submit',function(event){
            event.preventDefault();
            // get form submitted data
            let formData = new FormData(this);
            $.ajax({
                url: "cities",
                type:"POST",
                data: formData,
                contentType: false,
                processData: false,
                success:function(response){

                    if(response.city){
                        cities_table.prepend('<tr id ="'+response.city.id+'">'+
                            '<td><input type="checkbox" class="item_checkbox" name="item[]" value="'+response.city.id+'"></td>'+
                            '<td class="text-center sorting_1">'+response.city.city_name_ar+'</td>'+
                            '<td class=" text-center">'+response.city.city_name_en+'</td>'+
                            '<td class=" text-center">'+response.city.country_name+'</td>'+
                            '<td class=" text-center">'+response.city.created_at+'</td>'+
                            '<td class=" text-center">'+response.city.updated_at+'</td>'+
                            '<td class=" text-center edit_'+response.city.id+'">'+
                            '<td class=" text-center delete_'+response.city.id+'">'
                        );
                        var edit_btn = $('<button/>')
                            .attr('data-id', response.city.id)
                            .addClass('btn btn-info edit_city')
                            .attr('type', 'button')
                            .html('<i class="fa fa-edit" style="color: #fff"></i>');
                        $('.edit_'+response.city.id).append(edit_btn);
                        var delete_btn = $('<button/>')
                            .attr('data-id', response.city.id)
                            .addClass('btn btn-danger delete_city')
                            .attr('type', 'button')
                            .html('<i class="fa fa-trash"></i>');;
                        $('.delete_'+response.city.id).append(delete_btn);
                        toastr.success(response.message);
                        $('#add_city_modal').modal('hide');
                        document.getElementById('add_city_form').reset();
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


        $(document).on('click', 'button.edit_city',function(event) {
            $('.validation-errors').html('');
            var city_id = parseInt($(this).attr("data-id"));
            var url = "{{url('admin/cities/:city/edit')}}";
            url = url.replace(':city', city_id);
            $.ajax({
                url: url,
                type:"GET",
                data: {city_id: city_id},
                contentType: 'application/json; charset=utf-8',
                //dataType: 'json',
                success:function(response){
                    $('#city_id').val(response.id);
                    $('#edit_city_name_ar').val(response.city_name_ar);
                    $('#edit_city_name_en').val(response.city_name_en);
                    $('#edit_country_id').val(response.country_id);

                    // show edit city modal
                    $('#edit_city_modal').modal('show');
                }, error: function(xhr, status, error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    console.log('Error - ' + errorMessage);
                }
            });
        });

        // edit city form submition
        $('#edit_city_form').on('submit',function(event){
            event.preventDefault();
            // get form submitted data
            var city_id = $(".city_id_to_edit").attr("value");
            let formData = new FormData(this);
            var url = "{{url('admin/cities/:city_id')}}";
            url = url.replace(":city_id", city_id);
            $.ajax({
                url: url,
                type:"POST",
                data: formData,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response.city){
                        toastr.success(response.message);
                        $('#edit_city_modal').modal('hide');
                        // get tr by id and refresh
                        cities_table.find('tr').each(function(){
                            if($(this).attr('id') == city_id){
                                $(this).find('td').each (function(index, tr) {
                                    if(index == 1){
                                        $(this).html(response.city.city_name_ar);
                                    }
                                    if(index == 2){
                                        $(this).html(response.city.city_name_en);
                                    }
                                    if(index == 3){
                                        $(this).html(response.city.country_name);
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

        $(document).on('click', 'button.delete_city',function(event) {
            var city_id = parseInt($(this).attr("data-id"));
            $('#delete_city_modal').modal('show');
            $(".city_id_to_delete").attr("value", city_id);
        });

        // confirm delete city
        $('.delete_city_confirm').click(function(){
            var city_id = $(".city_id_to_delete").attr("value");
            var url = "{{url('admin/cities/:city')}}";
            url = url.replace(':city', city_id);
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
                    $('#delete_city_modal').modal('hide');
                    $('table#cities_table tr#'+city_id).remove();
                },
            });
        });
    </script>
@endsection
