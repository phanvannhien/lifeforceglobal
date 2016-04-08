
@include('back.header')
@include('back.nav')
@include('back.sidebar')


<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit product : {{ $product->product_name }}
      <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Edit product</a></li>
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
       	<form action="{{ route('back.product.update',$product->id) }}" method="post">
       		<input type="hidden" name="_token" value="{{ csrf_token() }}">
       		<input type="hidden" name="id" value="{{ $product->id }}">

       		<div class="box-body">
	            <div class="form-group">
	              	<label for="">Category ID</label>
	              	<select class="form-control" name="category_id" id="">
	              		<option value="1">Products Category</option>
	            	</select>
	            </div>
	            <div class="form-group">
		            <label for="">Product Name</label>
		            <input type="text" class="form-control" id="" name="product_name" placeholder="" value="{{ $product->product_name }}">
	            </div>

	            <div class="form-group">
		            <label for="">Sort Description</label>
					<textarea class="form-control" name="product_sort_description" id="" cols="30" rows="10">{{ $product->product_sort_description }}</textarea>
	            </div>

	             <div class="form-group">
		            <label for="">Description</label>
					<textarea class="form-control textarea" name="product_description" id="" cols="30" rows="10">{{ $product->product_description }}</textarea>
	            </div>

	            <div class="form-group">
		            <label for="">Product Price </label>
		            <input type="text" class="form-control" id="" name="price_RPP" placeholder="" value="{{ $product->price_RPP }}">
	            </div>

	            <div class="form-group">
		            <label for="">Product Discount (Member Only) </label>
		            <input type="text" class="form-control" id="" name="price_discount" placeholder="" value="{{ $product->price_discount }}">
	            </div>

	            <div class="form-group">
		            <label for="">Download File </label>
		            <input type="text" class="form-control" id="" name="download_file" placeholder=""  value="{{ $product->download_file }}">
	            </div>

	            <div class="form-group">
		            <label for="">Thumnail</label>
		            <input type="text" class="form-control" id="" name="product_thumbnail" placeholder=""  value="{{ $product->product_thumbnail }}">
	            </div>

	             <div class="form-group">
		            <label for="">Images</label>
		            <input type="text" class="form-control" id="" name="product_images" placeholder=""  value="{{ $product->product_images }}">
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

@include('back.footer')