@include ('front.includes.header')
@include ('front.nav')
<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="/">Home</a>
                </li>
                </li>
                <li class="active"> Order List</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-7">
            <h1 class="section-title-inner"><span><i class="fa fa-list-alt"></i> Order List </span></h1>
            <div class="row userInfo">
                <div class="col-lg-12">
                    <h2 class="block-title-2"> Your Order List </h2>
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
                            @foreach ( CustomerHelper::getOrders() as $order )
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
@include ('front.includes.footer')