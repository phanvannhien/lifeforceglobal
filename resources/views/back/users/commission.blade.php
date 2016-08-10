@extends('back.master')
@section('content')
        <!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Commission
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a class="" href="#">Commission</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        @include('back.message')
                <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">User Commission</h3>
            </div>
            <div class="box-body">
                <form action="{{route('back.users.commission.post',['id' => $id])}}" class="form-inline" method="post">
                    <input type="hidden" value="{{ csrf_token()  }}" name="_token">
                    <div class="form-group">
                        <label for="">Purchase From date - To date</label>
                        <input type="text" class="form-control" name="date_range" id="date-range" style="margin-bottom: 0">
                        <button type="submit" name="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>

                <p>&nbsp;</p>
                <p>Date: <strong>{{ $date['startDate'] .' - '.$date['endDate']  }}</strong></p>

                <table class="table treegrid">
                    <thead>
                    <tr>
                        <th> Member Email</th>
                        <th> Member Name</th>
                        <th> Member Status</th>
                        <th> Upline level</th>
                        <th> Total Purchase</th>
                        <td> Commission Upline</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    //$list = CustomerHelper::treeGridMembersList($members,Auth::user()->user_code);
                    ?>
                    <?php

                    $totalPurchase = 0;
                    $totalCommission = 0;

                    ?>
                    @if ( count($members) > 0 )

                        @foreach (  $members as $member )
                            <tr class="{{ $member->class.' '.$member->parent_class }}">
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->name }}</td>
                                <td><span class="label label-info">{{ ($member->user_status == 1) ? 'active' :'disactive'  }}</span></td>
                                <td>{{ $member->user_level }}</td>
                                <td><strong>{{ PriceHelper::formatPrice($member->totals) }}</strong></td>
                                <td><span class="label label-danger">{{ PriceHelper::formatPrice( $member->commission) }}</span></td>
                            </tr>

                            <?php
                            $totalPurchase += $member->totals ;
                            $totalCommission += $member->commission;
                            ?>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                <p>You don't have any members</p>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4" align="right">
                            Total
                        </td>
                        <td><strong>{{ PriceHelper::formatPrice($totalPurchase) }}</strong></td>
                        <td><strong>{{ PriceHelper::formatPrice($totalCommission) }}</strong></td>

                    </tr>
                    </tfoot>
                </table>

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

    <link rel="stylesheet" href="{{ url('assets/plugins/treegrid/css/jquery.treegrid.css') }}">
    <script src="{{ url('assets/plugins/treegrid/js/jquery.treegrid.js') }}"></script>
    <script src="{{ url('assets/plugins/treegrid/js/jquery.treegrid.bootstrap3.js') }}"></script>

    <script>
        $(function() {

            function cb(start, end) {
                $('#date-range').html(start.format('YYYY, M D') + '-' + end.format('YYYY, M D'));
            }
            cb(moment().startOf('month'), moment());

            $('#date-range').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

        });

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.treegrid').treegrid({
                expanderExpandedClass: 'fa fa-minus',
                expanderCollapsedClass: 'fa fa-plus'
            });
        });
    </script>
@endsection