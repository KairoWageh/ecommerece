@extends('admin.index')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <div class="box-body">
            <!-- {!! Form::open(['url' => adminURL('admin')]) !!} -->
            {!! Form::open(['route' => ['states.update', $state->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('state_name_ar', __('admin.name_ar')) !!}
                    {!! Form::text('state_name_ar', old('state_name_ar', $state->state_name_ar), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('state_name_en', __('admin.name_en')) !!}
                    {!! Form::text('state_name_en', old('state_name_en', $state->state_name_en), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_id', __('admin.country')) !!}
                    {!! Form::select('country_id', $countries, $country_id, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('city_id', __('admin.city')) !!}
                    {!! Form::select('city_id', $cities, old('city_id', $city_id), ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit(__('admin.edit'), ['class' => 'btn btn-primary']) !!}
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