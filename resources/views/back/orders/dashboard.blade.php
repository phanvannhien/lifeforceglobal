@extends('back.master')
@section('content')
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      All Orders
      <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a class="" href="#">Orders</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    @include('back.message')
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Orders</h3>
      </div>
      <div class="box-body">
        <form action="{{route('back.orders.post')}}" class="form-horizontal" method="post">
          <input type="hidden" value="{{ csrf_token() }}" name="_token">
          <table id="" class="table table-bordered table-hover">
            <thead>
              <tr>
                <td>Orders By</td>
                <td>ID</td>
                <td>Customer</td>
                <td>Status</td>
                <td>Order Date</td>
                <td>Action</td>
              </tr>
            </thead>
          <tr>
              <td>
                <select name="filter[checkout_type]" id="" class="form-control">
                  <option {{ (Input::get('filter')['checkout_type'] == '') ? 'selected' :'' }} value="">All</option>
                  <option {{ (Input::get('filter')['checkout_type'] == 'member') ? 'selected' :'' }}  value="member">Member</option>
                  <option {{ (Input::get('filter')['checkout_type'] == 'guest') ? 'selected' :'' }}  value="guest">Guest</option>
                </select>
              </td>
              <td><input value="{{Input::get('filter')['id']}}" size="5" type="text" name="filter[id]" class="form-control" placeholder=""></td>
              <td><input value="{{Input::get('filter')['email']}}" type="email" name="filter[email]" class="form-control" placeholder=""></td>
              <td>
                  <select class="form-control" name="filter[status]" id="">
                      <option {{ (Input::get('filter')['status'] == 'pending') ? 'selected' :'' }} value="pending">pending</option>
                      <option {{ (Input::get('filter')['status'] == 'cancel') ? 'selected' :'' }} value="cancel">cancel</option>
                      <option {{ (Input::get('filter')['status'] == 'done') ? 'selected' :'' }} value="done">done</option>
                  </select>
              </td>
              <td><input value="{{Input::get('filter')['created_at']}}" type="text" size="8" name="filter[created_at]" class="form-control reservation" placeholder="From - To"><br></td>
              <td>
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Filter</button>
              </td>
            </tr>
          </table>
        </form>
          <div class="clearfix">
            <p class="pull-right"> Showing <strong>{{$orders->count()}}</strong> orders </p>
          </div>
       		<table id="data-table" class="table table-bordered table-hover">
            <thead>
                    <tr>
                      <td>ID</td>
                      <td>Customer</td>
                      <td>Order Total</td>
                      <td>Shipping Fee</td>
                      <td>Total</td>
                      <td>Status</td>
                      <td>Order Date</td>
                      <td>Action</td>
                    </tr>
            </thead>
              <?php $total = 0 ?>
                @if (count($orders) > 0)
                    @foreach( $orders as $item)
                    <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->orderable->email }}</td>
                      <td>{{ PriceHelper::formatPrice($item->total) }}</td>
                      <td>{{ PriceHelper::formatPrice($item->shipping_fee) }}</td>
                      <td>{{ PriceHelper::formatPrice($item->total + $item->shipping_fee ) }}</td>
                      <td><lalel class="label label-info">{{ $item->status }}</lalel> </td>
                      <td>{{ $item->created_at }}</td>
                      <td>
                      <a href="{{ route('back.orders.edit',$item->id) }}"><i class="fa fa-edit"></i> View</a>   <br>
                      </td>
                    </tr>
                      <?php  $total += $item->total + $item->shipping_fee;?>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">Orders not found</td>
                    </tr>
                @endif
                <tfoot>
                    <tr>
                        <td colspan="8" align="right">Total: <strong>{{ PriceHelper::formatPrice($total)}}</strong></td>
                    </tr>
                </tfoot>
       		</table>
        
        <div class="dataTables_paginate paging_simple_numbers">
          {!! $orders->render() !!}
          <p class="">Showing {{$orders->firstItem()}}/{{$orders->lastItem()}} of {{$orders->total()}} results</p>
        </div>

      </div><!-- /.box-body -->

    </div><!-- /.box -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection

@section('footer')
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ url('AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
  <!-- date-range-picker -->
  <script src="{{ url('AdminLTE/plugins/daterangepicker/moment.min.js') }}"></script>
  <script src="{{ url('AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- DataTables -->
  <script src="{{ url('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script>

    //Date range picker
    $('.reservation').daterangepicker({
     // format: 'YYYY/DD/MM'
    });
  
    $('#data-table').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": false,
          "autoWidth": false
        });
  </script>
@endsection