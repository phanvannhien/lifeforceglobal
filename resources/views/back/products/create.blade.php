@extends('back.master')
@section('content')

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add product
      <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">Blank page</li>
    </ol>
  </section>
	<!-- Main content -->
  <section class="content">
	@if (Session::has('message') )
		<div class="alert alert-success alert-dismissable">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	    <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
	    {{ Session::get('message') }}
	  </div>
  	@endif

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Product</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
       	<form action="{{ route('back.product.save') }}" method="post">
       		<input type="hidden" name="_token" value="{{ csrf_token() }}">
       		<div class="box-body">
	            <div class="form-group">
	              	<label for="">Category ID</label>
	              	<select class="form-control" name="category_id" id="">
	              		@foreach( Site::allCategories() as $item )
	              		<option value="{{ $item->id }}">{{ $item->category_name }}</option>
	              		@endforeach
	            	</select>
	            </div>
	            <div class="form-group">
		            <label for="">Product Name</label>
		            <input type="text" class="form-control" id="" name="product_name" placeholder="">
	            </div>

	            <div class="form-group">
		            <label for="">Sort Description</label>
					<textarea class="form-control" name="product_sort_description" id="" cols="30" rows="10"></textarea>
	            </div>

	             <div class="form-group">
		            <label for="">Description</label>
					<textarea id="product-description" class="form-control" name="product_description" id="" cols="30" rows="10"></textarea>
	            </div>

	            <div class="form-group">
		            <label for="">Product Price </label>
		            <input type="text" class="form-control" id="" name="price_RPP" placeholder="">
	            </div>

	            <div class="form-group">
		            <label for="">Product Discount (Member Only) </label>
		            <input type="text" class="form-control" id="" name="price_discount" placeholder="">
	            </div>

	            <div class="form-group">
		            <label for="">Download File </label>
		            <div class="input-group">
	                  <span class="input-group-btn">
	                    <a id="lfm-file-download" data-input="download-file"class="btn btn-primary">
	                      <i class="fa fa-picture-o"></i> Choose File
	                    </a>
	                  </span>
	                  <input id="download-file" class="form-control" type="text" name="download_file">
	                </div>
	              
	            </div>

	            <div class="form-group">
		            <label for="">Thumnail</label>
		            <div class="input-group">
	                  <span class="input-group-btn">
	                    <a id="lfm-thumbnail" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
	                      <i class="fa fa-picture-o"></i> Choose Image
	                    </a>
	                  </span>
	                  <input id="thumbnail" class="form-control" type="text" name="product_thumbnail">
	                </div>
	                <img id="holder" style="margin-top:15px;max-height:100px;">
	            </div>
				<div class="panel panel-primary">
					<div class="panel-body">
			            <div class="form-group">
				            <label for="">Images 1</label>
				            <div class="input-group">
			                  <span class="input-group-btn">
			                    <a id="lfm-gallery1" data-input="gallery1" data-preview="gallery-holder1" class="btn btn-primary gallery">
			                      <i class="fa fa-picture-o"></i> Choose Image
			                    </a>
			                  </span>
			                  <input id="gallery1" class="form-control" type="text" name="product_images[]" multiple>

			                </div>
							<img id="gallery-holder1" style="margin-top:15px;max-height:100px;">
			            </div>

			            <div class="form-group">
				            <label for="">Images 2</label>
				            <div class="input-group">
			                  <span class="input-group-btn">
			                    <a id="lfm-gallery2" data-input="gallery2" data-preview="gallery-holder2" class="btn btn-primary gallery">
			                      <i class="fa fa-picture-o"></i> Choose Image
			                    </a>
			                  </span>
			                  <input id="gallery2" class="form-control" type="text" name="product_images[]" multiple>

			                </div>
							<img id="gallery-holder2" style="margin-top:15px;max-height:100px;">
			            </div>

			            <div class="form-group">
			   
				            <label for="">Images 3</label>
				            <div class="input-group">
			                  <span class="input-group-btn">
			                    <a id="lfm-gallery3" data-input="gallery3" data-preview="gallery-holder3" class="btn btn-primary gallery">
			                      <i class="fa fa-picture-o"></i> Choose Image
			                    </a>
			                  </span>
			                  <input id="gallery3" class="form-control" type="text" name="product_images[]">

			                </div>
							<img id="gallery-holder3" style="margin-top:15px;max-height:100px;">
			            </div>
					</div>            
				</div>
	         </div>
	         <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
       	</form>
      </div><!-- /.box-body -->
      
    </div><!-- /.box -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection

@section('footer')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
  $('textarea').ckeditor({
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
  $('#lfm-file-download').filemanager('file');
  $('.gallery').filemanager('image');
</script>

@endsection