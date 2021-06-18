@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#jstree').jstree({
            "core" : {
                'data' : {!! load_department($product->department_id) !!},
                "themes" : {
                  "variant" : "large"
                }
              },
              "checkbox" : {
                  "keep_selected_style" : true
              },
              "plugins" : ["wholerow"]
        });
    });
    $('#jstree').on('changed.jstree', function(e, data){
        var i, j, r = [];
        var name = [];
        for(i=0, j=data.selected.length; i<j; i++){
            r.push(data.instance.get_node(data.selected[i]).id);
            //name.push(data.instance.get_node(data.selected[i]).text);
        }
        var department_id = r.join(', ');
        $('.department_id').val(department_id);

        $.ajax({
          url: "{{ adminURL('load/shippingInfo')}}",
          dataType: "html",
          type: "post",
          data: {_token: '{{ csrf_token() }}', department_id: department_id, product_id: '{{ $product->id }}'},
          success: function(data){
            $('.shippingInfo').html(data);
            $('.info_data').removeClass('hidden');
          }, error: function(response){
            $.each(response.responseJSON.errors, function(index, value){
                  console.log('error::::::'+ value);
              });
          }
        });
   });
</script>
@endpush
<div id="department" class="tab-pane fade">
	<h3>{{__('admin.department')}}</h3>
	<div id="jstree"></div>
  <input type="hidden" name="department_id" class="department_id">
</div>