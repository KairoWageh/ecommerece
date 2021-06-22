@extends('admin.layouts.index')
@section('content')
<!-- @push('js')
<script type="text/javascript">
    $(document).ready(function(){
        @if(old('country_id'))
        $.ajax({
            url: '{{adminURL("states/create")}}',
            type: 'get',
            dataType: 'html',
            data: {country_id: '{{ old("country_id") }}', select: '{{ old("city_id") }}'},
            success: function(data)
            {
                $('.city').html(data);
            }
        });
        @endif
        $(document).on('change', '.country_id', function(){
            var country = $('.country_id option:selected').val();
            console.log('j'+country)
            if(country > 0)
            {
                $.ajax({
                    url: '{{adminURL("states/create")}}',
                    type: 'get',
                    dataType: 'html',
                    data: {country_id: country, select: ''},
                    success: function(data)
                    {
                        $('.city').html(data);
                    }
                });
            }else{
                $('.city').html('');
            }
        });
    })
</script>
@endpush -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['route' => 'states.store']) !!}
                <div class="form-group">
                    {!! Form::label('state_name_ar', __('admin.name_ar')) !!}
                    {!! Form::text('state_name_ar', old('state_name_ar'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('state_name_en', __('admin.name_en')) !!}
                    {!! Form::text('state_name_en', old('state_name_en'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_id', __('admin.country')) !!}
                    {!! Form::select('country_id', $countries, old('country_id'), ['class' => 'form-control', 'country_id', 'placeholder' => '.........']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('city_id', __('admin.city')) !!}
                    <!-- <span class="city"></span> -->
                    {!! Form::select('city_id', [], null, ['class' => 'form-control', 'city_id', 'placeholder' => '.........']) !!}
                </div>
                {!! Form::submit(__('admin.add'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
        </div>
    </div>
<!--  -->
@endsection

<script type="text/javascript">
    window.addEventListener('load', function() {
        $('select[name="country_id"]').on('change',function(){
               var countryID = jQuery(this).val();
               if(countryID)
               {
                  jQuery.ajax({
                     url : "{{ url('admin/states/getCountryCities') }}"+'/'+countryID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="city_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="city_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
            });
    });

</script>
