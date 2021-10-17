@push('js')
    <script>
        // var department_id = '';
        var department = new Object();
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
            if($('a.jstree-clicked')){
                department.department_id = document.getElementsByClassName("jstree-clicked")[0].parentElement.id;
            }
        });
        // save product into db
        function save_product(data){
            $.ajax({
                url: "{{url('admin/products')}}",
                type: "POST",
                data: {_token: '{{ csrf_token() }}', data: data},
                success:function(response){
                    // the new product which has been added recently
                    var product = response.product;
                    if(response.toast === 'success'){
                        toastr.success(response.message);
                        var tabs = document.getElementById("nav-tabs");
                        for(var i=0; i< tabs.getElementsByClassName("icon").length; i++){
                            var icons = document.getElementsByClassName("icon");
                            icons[i].style.display = "block";
                        }
                        $('.saved_product_id').val(product.id);
                    }else if(response.toast === 'error'){
                        toastr.error(response.message);
                    }
                }, error(response){
                    var error_li = '';
                    $.each(response.responseJSON.errors, function(index, value){
                        error_li += '<li>' + value + '</li>';
                    });
                    $('.validate_message').html(error_li);
                    $('.error_message').removeAttr('style');
                }
            });
        }
        // saving data from product info tab
        $('.save_product').click(function(){
            var title = $('.title').val();
            var department_id = department.department_id;
            var content = $('.content').val();
            var data = {title, department_id, content};
            save_product(data);
            return $.ajax({
                url: "{{url('admin/products')}}",
                type: "GET",
            });
        });
    </script>
@endpush
<div id="product_info" class="tab-pane fade in active">
    <div class ="validation-errors"></div>
    <div class="tab_title">
        <h3>{{__('product_info')}}</h3>
    </div>
    <div class="clearfix"></div>
    @if(isset($product))
 	<div class="form-group">
 		{!! Form::label('title', __('product_title')) !!}
 		{!! Form::text('title', $product->title, ['class' => 'form-control title', 'placeholder' => __('product_title')]) !!}
 	</div>
 	<div class="form-group">
 		{!! Form::label('content', __('product_content')) !!}
 		{!! Form::textarea('content', $product->content, ['class' => 'form-control content', 'placeholder' => __('product_content')]) !!}
 	</div>
    @else
        <div class="form-group">
            {!! Form::label('title', __('product_title')) !!}
            {!! Form::text('title', '', ['class' => 'form-control title', 'placeholder' => __('product_title')]) !!}
        </div>
{{--    product department--}}
        {!! Form::label(__('department')) !!}
        <div id="jstree"></div>
        <div class="form-group">
            {!! Form::label('content', __('product_content')) !!}
            {!! Form::textarea('content', '', ['class' => 'form-control content', 'placeholder' => __('product_content')]) !!}
        </div>
    @endif
    <a href="#" class="btn btn-primary save_product">{{__('save')}}<i class="fa fa-floppy-o"></i></a>
</div>


