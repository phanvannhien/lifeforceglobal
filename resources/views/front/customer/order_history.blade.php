@section('head.script')
<!-- Include Required Prerequisites -->

<!-- Include Date Range Picker -->
<link rel="stylesheet" type="text/css" href="/assets/plugins/daterangepicker/daterangepicker.css" />
@endsection
@include ('front.includes.header')
@include ('front.nav')
<div class="container main-container headerOffset">
    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2 class="section-title-inner"><span><i class="fa fa-list-alt"></i> Order List </span></h2>
            <div class="row userInfo">
                <div class="col-lg-12">
                   
                    <form action="" class="form-inline pull-right" method="post">
                        <input type="hidden" value="{{ csrf_token()  }}" name="_token">
                        <div class="form-group">
                            <input type="text" class="form-control" name="date_range" id="date-range" style="margin-bottom: 0">
                            <button type="submit" name="submit" class="btn btn-primary">Filter</button>
                        </div>

                    </form>
                    <p class="clearfix">&nbsp;</p>
                </div>
                <div style="clear:both"></div>
                <div class="col-xs-12 col-sm-12">
                    <table class="footable">
                        <thead>
                            <tr>
                                <th data-class="expand" data-sort-initial="true"><span title="table sorted by this column on load">Order ID</span>
                                </th>
                                <th data-hide="phone,tablet" data-sort-ignore="true">No. of items</th>
                                
                                <th data-hide="phone,tablet"><strong></strong>
                                </th>
                                <th data-hide="default"> Total</th>
                                <th data-hide="default" data-type="numeric"> Date</th>
                                <th data-hide="phone" data-type="numeric"> Status</th>
                                <th data-hide="phone" data-type="numeric"> View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $orders as $order )
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ CustomerHelper::getCountItemOrders($order->id) }}
                                    <small>item(s)</small>
                                
                                </td>
                                <td><a target="_blank">-</a>
                                </td>
                                <td>{{ PriceHelper::formatPrice($order->total) }}</td>
                                <td data-value="">{{ $order->created_at }}</td>
                                <td data-value=""><span class="label label-success">{{ $order->status }}</span>
                                </td>
                                <td><a href="{{ route('front.order.status',$order->id) }}" class="btn btn-primary btn-sm">view</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
@section('footer')
<script type="text/javascript" src="/assets/plugins/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
<script>
    $(function() {

        function cb(start, end) {
            $('#date-range').html(start.format('YYYY, M D') + '-' + end.format('YYYY, M D'));
        }
        cb(moment().subtract(29, 'days'), moment());

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
@endsection
@include ('front.includes.footer')
