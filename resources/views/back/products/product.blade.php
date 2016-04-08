
@include('back.header')
@include('back.nav')
@include('back.sidebar')


<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      All Product
      <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Product</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

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
       		<table class="table table-striped">
       			<tr>
       				<td>Product Name</td>
       				<td>Product Category</td>
       				<td>Thumnail</td>
       				<td>Function</td>
       			</tr>
       			@foreach( $products as $product)
				<tr>
       				<td>{{ $product->product_name }}</td>
       				<td>{{ $product->category_id }}</td>
       				<td><img src="{{ url('media/product/images/'.$product->product_thumbnail) }}" width="100" alt=""> </td>
       				<td></td>
       			</tr>

       			@endforeach
       		</table>
      </div><!-- /.box-body -->
      
    </div><!-- /.box -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@include('back.footer')