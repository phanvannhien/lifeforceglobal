@extends('master')

@section('content')

<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="/">Home</a>
                </li>
                </li>
                <li class="active">Members of</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-7">
            <h1 class="section-title-inner"><span><i class="fa fa-list-alt"></i> Members of </span></h1>
            <div class="row userInfo">
                <div class="col-lg-12">
                    <h2 class="block-title-2"> Members of 
						<span class="pull-right"> Total <strong>{{$members->total()}}</strong> members </span>
                    </h2>

                </div>
                <div style="clear:both"></div>
                <div class="col-xs-12 col-sm-12">
                    <table class="footable table">
                        <thead>
                            <tr>
                                <th data-class="expand" data-sort-initial="true">
                                	<span title="">No.</span>
                                </th>
                                <th data-hide="default"> Member Name</th>
                                <th data-hide="default" data-type=""> Member Email</th>
                                <th data-hide="default" data-type=""> Member Status</th>
                                <th data-hide="default" data-type=""> Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php $i = 1; $total = 0; ?>
                        	@if ( count($members) > 0 )
                            @foreach (  $members as $member )
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->email }}</td>
                                <td><span class="label label-info">{{ ($member->user_status == 1) ? 'active' :'disactive'  }}</span></td>
                                <td> <strong>{{ PriceHelper::formatPrice($member->register_fee) }}</strong></td>
                            </tr>
                            <?php $i++ ; $total +=$member->register_fee  ?>
                            @endforeach
                            @else
							<tr>
								<td colspan="5">
									<p>You don't have any members</p>
								</td>
							</tr>
                            @endif
                            
                        </tbody>
                        <tfoot>
                        	<tr>
                        		<td colspan="5" align="right">
                        			<span>Total: <strong>{{ PriceHelper::formatPrice($total) }}</strong></span>
                        		</td>
                        	</tr>
                        </tfoot>
                    </table>

                </div>
                <div class="w100 categoryFooter">
                  <div class="pagination pull-left no-margin-top">
                     {!! $members->links() !!}
                  </div>
                  <div class="pull-right pull-right col-sm-4 col-xs-12 no-padding text-right text-left-xs">
                     <p>Showing {{$members->firstItem()}}/{{$members->lastItem()}} of {{$members->total()}} results</p>
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
	
@endsection