@extends('back.master')
@section('content')
        <!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Orders: <strong>#{{$order->id}}</strong>
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
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Customer infomation</h3>
                    </div>
                    <div class="box-body">
                        <p>Customer Name: {{$order->user->name }}</p>
                        <p>Email: {{$order->user->email }}</p>
                    </div>
                </div><!-- /.box -->
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order infomation</h3>
                    </div>
                    <div class="box-body">
                        <p>Order Date: {{$order->created_at }}</p>
                        <p>Shipping Address: {{$order->address }}</p>
                        <p>Status: <label for="" class="label label-info">{{ $order->status }}</label></p>
                        <form action="{{ route('back.order.changestatus') }}" method="post">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <input type="hidden" value="{{ $order->id }}" name="id">
                            <div class="form-group">
                                <label for="">Change status</label>
                                
                                    @if ( $order->status == 'pending' )
                                        <select name="status" id="" class="form-control">
                                        <option value="processing">processing</option>
                                        <option value="done">done</option>
                                        <option value="cancel">cancel</option>
                                        </select>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    @elseif ( $order->status == 'processing' )
                                        <select name="status" id="" class="form-control">
                                        <option value="done">done</option>
                                        <option value="cancel">cancel</option>
                                        </select><br>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    @else
                                        <p>Can't change status</p>
                                    @endif
                            </div>

                            
                        </form>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Orders items</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Product ID</td>
                            <td>Product Name</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Sub Total</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0; ?>
                    @foreach( $order->details as $itemd )
                    <tr>
                        <td>{{$itemd->product_id}}</td>
                        <td>{{$itemd->getProduct->product_name}}</td>
                        <td>{{$itemd->qty}}</td>
                        <td>{{ PriceHelper::formatPrice($itemd->price) }}</td>
                        <td>{{ PriceHelper::formatPrice($itemd->subtotal) }}</td>
                    </tr>
                    <?php $total += $itemd->subtotal; ?>
                    @endforeach
                    </tbody>
                    <tfooter>
                        <tr>
                            <td colspan="5" align="right">
                                Total: <strong>{{ PriceHelper::formatPrice($total) }}</strong>
                            </td>
                        </tr>
                    </tfooter>

                </table>
            </div>
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
    $('.reservation').daterangepicker();
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