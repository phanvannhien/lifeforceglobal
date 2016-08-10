@extends('master')

@section('content')
<?php $total = 0 ?>
<div class="container main-container headerOffset">
   
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2 class="section-title-inner"><span><i class="fa fa-list-alt"></i> Members of </span></h2>
            <div class="row userInfo">
                <div class="col-lg-12">
                   <p class="pull-right"> Total <strong>{{ count($members) }}</strong> members </p>
                </div>
                <div class="col-lg-12">
                <div style="clear:both"></div>
                <p class="pull-left">From: {{ $date['startDate'] }} To: {{ $date['endDate'] }}</p>
                <form action="{{route('user.memberssof.filter')}}" class="form-inline pull-right" method="post">
                    <input type="hidden" value="{{ csrf_token()  }}" name="_token">
                    <div class="form-group">
                        <input type="text" class="form-control" name="date_range" id="date-range" style="margin-bottom: 0">
                        <button type="submit" name="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
                <p style="clear:both">&nbsp;</p>
                </div>
                <div class="col-xs-12 col-sm-12">
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

                </div>
                <div class="w100 categoryFooter">
                  <div class="pagination pull-left no-margin-top">
                     
                  </div>
                  <div class="pull-right pull-right col-sm-4 col-xs-12 no-padding text-right text-left-xs">
                     
                  </div>
               </div>
                <div style="clear:both"></div>
                <div class="col-lg-12 clearfix">
                    <ul class="pager">
                        <li class="previous pull-right">
                            <a href="/"> <i class="fa fa-home"></i> Go to Shop </a>
                        </li>
                        <li class="next pull-left"><a href="{{ route('user.dashboard') }}"> &larr; Back to My Account</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-5"></div>
    </div>

    <div style="clear:both"></div>
</div>

<div class="gap"></div>
@endsection


@section('footer')
<link rel="stylesheet" href="{{ url('assets/plugins/treegrid/css/jquery.treegrid.css') }}">
<script src="{{ url('assets/plugins/treegrid/js/jquery.treegrid.js') }}"></script>
<script src="{{ url('assets/plugins/treegrid/js/jquery.treegrid.bootstrap3.js') }}"></script>
<script type="text/javascript" src="/assets/plugins/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Include Date Range Picker -->
<link rel="stylesheet" type="text/css" href="/assets/plugins/daterangepicker/daterangepicker.css" />
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