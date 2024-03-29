@push('js')
<script type="text/javascript">
    // $(document).ready(function(){
        var data = {!! load_department() !!};
        var product_id = $('.saved_product_id').val();

        // alert('product_id::::'+product_id);
        console.log('product_id::::'+product_id);
        <?php
            if(isset($product)){
        ?>
            data = <?php load_department($product->department_id) ?>
            product_id = <?php $product->id?>
            <?php }
        ?>
        $('#jstree').jstree({
            "core" : {
                'data' : data,
                "themes" : {
                  "variant" : "large"
                }
            },
            "checkbox" : {
                "keep_selected_style" : true
            },
            "plugins" : ["wholerow"]
        });
    // });
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
          data: {_token: '{{ csrf_token() }}', department_id: department_id, product_id: product_id},
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

   $(document).ready(function(){
       $('#jstree').jstree({
           'core' : {
               'data' : {!! load_department(old('parent_id')) !!},
               "themes" : {
                   "variant" : "large"
               }
           },
           "checkbox" : {
               "keep_selected_style" : false
           },
           "plugins" : ["wholerow"]
       });
   });
   $('#jstree').on('changed.jstree', function(e, data){
       var i, j, r = [];
       for(i=0, j=data.selected.length; i<j; i++){
           r.push(data.instance.get_node(data.selected[i]).id);
       }
       $('.parent_id').val(r.join(', '));
   });
</script>
@endpush
<div id="department" class="tab-pane fade">
    <div class="tab_title">
        <h3>{{__('department')}}</h3>
    </div>
    <div class="clearfix"></div>
	<div id="jstree"></div>
    <input type="hidden" name="department_id" class="department_id">
</div>
