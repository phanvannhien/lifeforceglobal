@section('head.script')
<!-- Include Date Range Picker -->
<link rel="stylesheet" type="text/css" href="/assets/plugins/daterangepicker/daterangepicker.css" />
@endsection
@include ('front.includes.header')
@include ('front.nav')

<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="/">Home</a>
                </li>
                <li class="active"> My account</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h1 class="section-title-inner"><span><i class="fa fa-unlock-alt"></i> My account </span></h1>
            <div class="row userInfo">
                <div class="col-xs-12 col-sm-12">
                    <h2 class="block-title-2"><span>Welcome to your account. Here you can manage all of your personal information and orders.</span></h2>
                    <ul class="myAccountList row">
                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail equalheight" style="height: 104px;">
                            <a title="Orders" href="{{ route('user.order.history') }}"><i class="fa fa-calendar"></i> Order history </a>
                            </div>
                        </li>
                     
                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail equalheight" style="height: 104px;">
                                <a title="Add  address" href="{{ route('user.address') }}"> <i class="fa fa-edit"> </i> Add address</a>
                            </div>
                        </li>
                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail equalheight" style="height: 104px;">
                            <a title="Personal information" href="{{ route('user.info') }}"><i class="fa fa-cog"></i>
Personal information</a>
                            </div>
                        </li>

                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                            <div class="thumbnail equalheight" style="height: 104px;">
                            <a title="Personal information" href="{{ route('user.memberssof') }}"><i class="fa fa-user"></i>
Members Of</a>
                            </div>
                        </li>
                        
                      
                    </ul>
                    <div class="clear clearfix"></div>
                </div>
            </div>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-5"></div>
    </div>

    <div style="clear:both"></div>
    
    @if ( Auth::user()->user_role == 'WM' )
    <div class="row">
       
        <div class="col-sm-12">
            <h2 class="block-title-2"><span>WM commission</span></h2>
            <form action="{{ route('user.dashboard.post') }}" class="form-inline" method="post">
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                <input style="margin-bottom:0" class="form-control" type="text" id="date-range" name="date_range" value="" placeholder="Date Start - Date End">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
            </form>
            <p>&nbsp;</p>
            @if( isset($commission) && count($commission) > 0 )
               <table class="table">
                   <thead>
                       <th>Total</th>
                       <th>Commission (10%)</th>
                   </thead>
                   <tbody>
                       @foreach($commission as $c)
                        <tr>
                            <td>{{ PriceHelper::formatPrice($c->totals) }}</td>
                            <td>{{ PriceHelper::formatPrice($c->commission) }}</td>
                        </tr>
                       @endforeach
                   </tbody>
               </table> 
            @endif
        </div>
    </div>
    @endif
</div>

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