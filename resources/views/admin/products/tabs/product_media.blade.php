@push('js')
<link rel="stylesheet" type="text/css" href="{{asset('public/design/admin/css/dropzone.min.css')}}">
<script type="text/javascript" src="{{asset('public/design/admin/js/dropzone.min.js')}}"></script>
<script type="text/javascript">
    //Dropzone Configuration
    Dropzone.autoDiscover = false;
	$(document).ready(function(){
       <?php
        if(isset($product)){?>
            var main_edit_url = {{'/ecommerce/public/admin/update/image/'.$product->id}};
            var main_delete_url = {{ adminURL('/ecommerce/public/admin/delete/product/image/'.$product->id) }};
            var edit_url = {{ adminURL('/ecommerce/public/admin/upload/image/'.$product->id) }};
        <?php }else{?>
            var main_edit_url = '/ecommerce/public/admin/update/image/';
            var main_delete_url = '/ecommerce/public/admin/delete/product/image/';

            var edit_url = '/ecommerce/public/admin/update/image/';

        <?php }?>
        var delete_url = '/ecommerce/public/admin/delete/product/image/';
		$('#mainPhoto').dropzone({
			url: main_edit_url,
			paramName: 'file',
			uploadMultiple: false,
			maxFiles: 1,
			maxFilessize: 3, //MB
			acceptedFiles: 'image/*',
			dictDefaultMessage: "{{__('mainPhoto')}}",
			dictRemoveFile: "{{__('delete')}}",
			params: {
				_token: '{{ csrf_token() }}'
			},
			addRemoveLinks: true,
			removedfile: function(file){
				$.ajax({
					dataType: 'json',
					type: 'post',
					url: main_delete_url,
					data: {_token: '{{ csrf_token() }}'}
				});
				var fmock;
				return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement) : void 0;
			},
			init: function(){
				@if(!empty($product->photo))
					var mock = {name: '{{ $product->title }}', size: '', type: ''};
					this.emit('addedfile', mock);
					this.options.thumbnail.call(this, mock, '{{ Storage::url($product->photo) }}');
					$('.dz-progress').remove();
				@else
					console.log('empty product photo')
				@endif
				this.on('sending', function(file, xhr, formData){
					formData.append('fid', '');
					file.fid = '';
				});

				this.on('success', function(file, response){
					file.fid = response.id;
				})
			}
		});
		$('#dropzonefileupload').dropzone({
			url: edit_url,
			paramName: 'file',
			uploadMultiple: false,
			maxFiles: 15,
			maxFilessize: 2, //MB
			acceptedFiles: 'image/*',
			dictDefaultMessage: "{{__('uploadProductMedia')}}",
			dictRemoveFile: "{{__('delete')}}",
			params: {
				_token: '{{ csrf_token() }}'
			},
			addRemoveLinks: true,
			removedfile: function(file){
				$.ajax({
					dataType: 'json',
					type: 'post',
					url: delete_url,
					data: {_token: '{{ csrf_token() }}', id: file.fid}
				});
				var fmock;
				return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement) : void 0;
			},
			init: function(){
                @if(isset($product))
                    @foreach($product->files()->get() as $file)
                        var mock = {name: '{{ $file->name }}', fid: '{{ $file->id }}', size: '{{ $file->size }}', type: '{{ $file->mime_type }}'};
                        this.emit('addedfile', mock);
                        //this.options.thumbnail.call(this, mock, '{{ url("storage/".$file->full_file) }}');
                        this.options.thumbnail.call(this, mock, '{{ Storage::url($file->full_file) }}');
                    @endforeach
				@endif
				this.on('sending', function(file, xhr, formData){
					formData.append('fid', '');
					file.fid = '';
				});
				this.on('success', function(file, response){
					file.fid = response.id;
				})
			}
		});
	});
</script>
<style type="text/css">
	.dz-image img{
		width: 100px;
		height: 100px;
	}
</style>
@endpush
<div id="product_media" class="tab-pane fade">
	<h3>{{ __('product_media') }}</h3>
	<hr />
	<center><h3>{{__('mainPhoto')}}</h3></center>
	<div class="dropzone" id="mainPhoto"></div>
	<hr />
	<center><h3>{{__('photos')}}</h3></center>
	<div class="dropzone" id="dropzonefileupload"></div>
</div>
