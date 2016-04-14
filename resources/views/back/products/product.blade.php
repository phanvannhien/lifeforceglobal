
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
      <a class="btn btn-success" href="{{ route('back.product.create') }}">Create new</a>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a class="" href="#">Product</a></li>
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
       				<td>Price </td>
       				<td>Function</td>
       			</tr>
       			@foreach( $products as $product)
				<tr>
       				<td>{{ $product->product_name }}</td>
       				<td>{{ $product->category_id }}</td>
       				<td>{{ $product->price_RPP }}</td>
       				<td>
              <a href="{{ route('back.product.edit',$product->id) }}"><i class="fa fa-edit"></i> Edit</a>   
              <a onclick="return confirm('Are you sure?')" href="{{ route('back.product.delete',$product->id) }}"><i class="fa fa-remove"></i> Delete</a>   
              </td>
       			</tr>

       			@endforeach
       		</table>
      </div><!-- /.box-body -->
      
    </div><!-- /.box -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@include('back.footer')