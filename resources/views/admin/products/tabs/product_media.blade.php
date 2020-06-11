@push('js')
<link rel="stylesheet" type="text/css" href="{{asset('design/adminpanel/css/dropzone.min.css')}}">
<script type="text/javascript" src="{{asset('design/adminpanel/js/dropzone.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#mainPhoto').dropzone({
			url: "{{ adminURL('/ecommerce/public/admin/update/image/'.$product->id) }}",
			paramName: 'file',
			uploadMultiple: false,
			maxFiles: 1,
			maxFilessize: 3, //MB
			acceptedFiles: 'image/*',
			dictDefaultMessage: "{{__('admin.mainPhoto')}}",
			dictRemoveFile: "{{__('admin.delete')}}",
			params: {
				_token: '{{ csrf_token() }}'
			},
			addRemoveLinks: true,
			removedfile: function(file){
				$.ajax({
					dataType: 'json',
					type: 'post',
					url: "{{ adminURL('/ecommerce/public/admin/delete/product/image/'.$product->id) }}",
					data: {_token: '{{ csrf_token() }}'}
				});
				var fmock;
				return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement) : void 0;
			},
			init: function(){
				@if(!empty($product->photo))
					var mock = {name: '{{ $product->title }}', size: '', type: ''};
					this.emit('addedfile', mock);
					this.options.thumbnail.call(this, mock, '{{ url("storage/".$product->photo) }}');
					$('.dz-progress').remove();
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
			url: "{{ adminURL('/ecommerce/public/admin/upload/image/'.$product->id) }}",
			paramName: 'file',
			uploadMultiple: false,
			maxFiles: 15,
			maxFilessize: 2, //MB
			acceptedFiles: 'image/*',
			dictDefaultMessage: "{{__('admin.uploadProductMedia')}}",
			dictRemoveFile: "{{__('admin.delete')}}",
			params: {
				_token: '{{ csrf_token() }}'
			},
			addRemoveLinks: true,
			removedfile: function(file){
				$.ajax({
					dataType: 'json',
					type: 'post',
					url: "{{ adminURL('/ecommerce/public/admin/delete/image') }}",
					data: {_token: '{{ csrf_token() }}', id: file.fid}
				});
				var fmock;
				return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement) : void 0;
			},
			init: function(){
				@foreach($product->files()->get() as $file)
					var mock = {name: '{{ $file->name }}', fid: '{{ $file->id }}', size: '{{ $file->size }}', type: '{{ $file->mime_type }}'};
					this.emit('addedfile', mock);
					//this.options.thumbnail.call(this, mock, '{{ url("storage/".$file->full_file) }}');
					this.options.thumbnail.call(this, mock, '{{ Storage::url($file->full_file) }}');
				@endforeach

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
	<h3>{{ __('admin.product_media') }}</h3>
	<hr />
	<center><h3>{{__('admin.mainPhoto')}}</h3></center>
	<div class="dropzone" id="mainPhoto"></div>
	<hr />
	<center><h3>{{__('admin.photos')}}</h3></center>
	<div class="dropzone" id="dropzonefileupload"></div>
</div>