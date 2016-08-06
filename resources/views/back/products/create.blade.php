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
					<p class="fileinput fileinput-new" data-provides="fileinput">
						<span class="btn green btn-file">
						<span class="fileinput-new"> Change Logo </span>
						<span class="fileinput-exists"> Change Logo</span>
						<input data-companyid="" class="uploadfile" type="file" name="file_logo"> </span>
					</p>
	                <img id="thumbnail-holder" style="margin-top:15px;max-height:100px;">
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
	<script>
		$("input.uploadfile").change(function(){
			var file = this.files[0];
			var formData = new FormData();
			formData.append('formData', file);

			if($('#companyname').length > 0){
				formData.append('companyname', $('#companyname').val());
			}

			$.ajax({
				url: '/ajax/changeLogoCompany',  //Server script to process data
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': '{{ csrf_token() }}'
				},
				data: formData,
				contentType: false,
				processData: false,
				//Ajax events
				success: function(data){
					if(data.success){
						$('.profile-userpic > img').attr('src',data.file);
						$('.page-logo > img').attr('src',data.file);
					}else{
						App.alert({'message': data.msg});
					}

				}
			});
		})


	</script>

@endsection