<!-- Add state modal start -->
<div class="modal fade" id="add_state_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('add')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class ="validation-errors"></div>
            {!! Form::open(["id"=>"add_state_form", "method"=>"POST", "enctype"=>"multipart/form-data"]) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('state_name_ar', __('name_ar')) !!}
                    {!! Form::text('state_name_ar', old('state_name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('state_name_en', __('name_en')) !!}
                    {!! Form::text('state_name_en', old('state_name_en'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_id', __('country')) !!}
                    {!! Form::select('country_id', $countries, old('country_id'), ['class' => 'form-control', 'country_id', 'placeholder' => '.........']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('city_id', __('city')) !!}
                    <!-- <span class="city"></span> -->
                    {!! Form::select('city_id', [], null, ['class' => 'form-control', 'city_id', 'placeholder' => '.........']) !!}
                </div>
{{--                {!! Form::submit(__('admin.add'), ['class' => 'btn btn-primary']) !!}--}}
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('add')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Add state modal end -->

{{--<script type="text/javascript">--}}
{{--    window.addEventListener('load', function() {--}}
{{--        $('select[name="country_id"]').on('change',function(){--}}
{{--               var countryID = jQuery(this).val();--}}
{{--               if(countryID)--}}
{{--               {--}}
{{--                  jQuery.ajax({--}}
{{--                     url : "{{ url('admin/states/getCountryCities') }}"+'/'+countryID,--}}
{{--                     type : "GET",--}}
{{--                     dataType : "json",--}}
{{--                     success:function(data)--}}
{{--                     {--}}
{{--                        console.log(data);--}}
{{--                        jQuery('select[name="city_id"]').empty();--}}
{{--                        jQuery.each(data, function(key,value){--}}
{{--                           $('select[name="city_id"]').append('<option value="'+ key +'">'+ value +'</option>');--}}
{{--                        });--}}
{{--                     }--}}
{{--                  });--}}
{{--               }--}}
{{--            });--}}
{{--    });--}}

{{--</script>--}}
