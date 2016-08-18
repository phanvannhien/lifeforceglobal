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
        <form action="{{route('back.orders.post')}}" class="form-horizontal" method="get">
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
                      <option {{ (Input::get('filter')['status'] == '') ? 'selected' :'' }} value="">All</option>
                      <option {{ (Input::get('filter')['status'] == 'pending') ? 'selected' :'' }} value="pending">pending</option>
                      <option {{ (Input::get('filter')['status'] == 'cancel') ? 'selected' :'' }} value="cancel">cancel</option>
                      <option {{ (Input::get('filter')['status'] == 'done') ? 'selected' :'' }} value="done">done</option>
                  </select>
              </td>
              <td><input value="{{Input::get('filter')['created_at']}}" type="text" size="8" name="filter[created_at]" class="form-control reservation" placeholder="From - To"><br></td>
              <td>

                  <input type="submit" value="Filter" name="_order_filter" class="btn btn-primary">
                  <input type="submit" value="Export Excel" name="_order_export_excel" class="btn btn-info">
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
                      <td>GST Tax(%)</td>
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
                      <td>
                       
                      <a href="{{ route('back.users',[
                          'filter[name]' => '',
                          'filter[email]' => $item->orderable->email,
                          'filter[user_code]' => '',
                          'filter[user_refferal]' => '',
                          'filter[user_status]' => '',
                          'filter[membership_number]' => '',
                          'filter[user_role]' =>'',
                          'filter[registration_date]' => '',
                          'filter[purchase_date]' => '',
                          'filter[perpage]' => 20

                      ]) }}">{{ $item->orderable->email }}</a></td>
                      <td>{{ PriceHelper::formatPrice($item->total) }}</td>
                      <td>{{ PriceHelper::formatPrice($item->shipping_fee) }}</td>
                      <td>{{ PriceHelper::formatPrice( $item->gst_tax ) }}</td>
                      <td>{{ PriceHelper::formatPrice($item->total_include_tax ) }}</td>
                      <td><lalel class="label label-info">{{ $item->status }}</lalel> </td>
                      <td>{{ $item->created_at }}</td>
                      <td>
                      <a href="{{ route('back.orders.edit',$item->id) }}"><i class="fa fa-edit"></i> View</a>   <br>
                      </td>
                    </tr>
                      <?php  $total += $item->total + $item->gst_tax/100;?>
                    @endforeach
                @else
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                @endif
                <tfoot>
                    <tr>
                        <td colspan="9" align="right">Total: <strong>{{ PriceHelper::formatPrice($total)}}</strong></td>
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