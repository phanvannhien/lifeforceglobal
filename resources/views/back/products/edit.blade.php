@extends('back.master')
@section('content')
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit product : {{ $product->product_name }}
      <a class="btn btn-success" href="{{ route('back.product') }}">Back</a>
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
      </div>
      <div class="box-body">
       	<form action="{{ route('back.product.update',$product->id) }}" method="post">
       		<input type="hidden" name="_token" value="{{ csrf_token() }}">
       		<input type="hidden" name="id" value="{{ $product->id }}">

       		<div class="box-body">
	            <div class="form-group">
	              	<label for="">Category ID</label>
	              	<select class="form-control" name="category_id" id="">
	              		@foreach( Site::allCategories() as $item )
	              		<option {{ ( $item->id == $product->category_id ) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->category_name }}</option>
	              		@endforeach
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
					<textarea class="form-control" name="product_description" id="product-description" cols="30" rows="10">{{ $product->product_description }}</textarea>
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
                  <label for="">Product Status</label>
                  <select name="status" class="form-control" id="">
                    <option {{ ($product->status == 1) ? 'selected' :'' }} value="1">Activated</option>
                    <option {{ ($product->status == 0) ? 'selected' :'' }} value="0">Deactivated</option>
                  </select>
                </div>  
				<?php
				$fileDownload = '';
				if($product->download_file != ''){
					$media = \App\Models\Medias::find($product->download_file);
					$fileDownload = $media->file_url;
				}

				?>
	            <div class="form-group">
		            <label for="">Download File </label>
                    (<span class="text-muted">PDF file and 5Mb available</span>)
					<p class="fileinput fileinput-new" data-provides="fileinput">
						<input type="hidden" value="{{ $product->download_file  }}" name="download_file">
                        <input type="text" disabled value="{{ $fileDownload  }}" name="download_file_url" class="form-control">
                        <br>
						<span class="btn green btn-primary">
						<span class="fileinput-new"> Select File</span>
						<input data-type="pdf" data-pid="{{ $product->id }}" class="uploadfile" type="file" name="fileupload">
						</span>
					</p>
	            </div>
                <?php
					$thumbUrl = '';
					if($product->product_thumbnail != ''){
						$media = \App\Models\Medias::find($product->product_thumbnail);
						$thumbUrl = $media->file_url;
					}

                ?>
	            <div class="form-group">
		            <label for="">Thumbnail</label>
                    (<span for="" class="text-muted">Image file and 2Mb available</span>)
					<p class="fileinput fileinput-new" data-provides="fileinput">
                        <input type="hidden" value="{{ $product->product_thumbnail  }}" name="product_thumbnail">
						<span class="btn green btn-primary">
						<span class="fileinput-new"> Select File </span>
						<input data-type="thumbnail" data-pid="{{ $product->id }}" class="uploadfile" type="file" name="fileupload">
                        <div class="holder">
                            <img src="{{ $thumbUrl }}" style="margin-top:15px;max-height:100px;">
                        </div>

						</span>
					</p>

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
            var that = this;
			var file = that.files[0];
			var formData = new FormData();
			formData.append('formData', file);
            formData.append('type', $(that).data('type'));
            formData.append('pid', $(that).data('pid'));
			$.ajax({
				url: '/admin/ajax/uploadfile',  //Server script to process data
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': '{{ csrf_token() }}'
				},
				data: formData,
				contentType: false,
				processData: false,
				//Ajax events
				success: function(data){
                    console.log(data);
					if(data.success ){
                        if(data.ext =='thumbnail'){
                            var img = $('<img/>').attr('src',data.file).attr('width','100');
                            $('.holder').html(img);
                            $('input[name=product_thumbnail]').val(data.mid);
                        }else{
                            $('input[name=download_file]').val(data.mid);
							$('input[name=download_file_url]').val(data.file);
                        }

					}else{
                        alert(data.msg);
					}

				}
			});
		})


	</script>

@endsection