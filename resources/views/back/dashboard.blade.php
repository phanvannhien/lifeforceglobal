@extends('back.master')
@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Dashboard</h1>
		<ol class="breadcrumb">
			  <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
			  <li class="active">Dashboard</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
		 	<div class="col-md-3 col-sm-6 col-xs-12">
		 		<a href="{{ route('back.orders') }}">
	              <div class="info-box">
	                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
	                <div class="info-box-content">
	                  <span class="info-box-text">Sales</span>
	                  <span class="info-box-number">{{ Site::getTotalOrders() }}</span>
	                </div><!-- /.info-box-content -->
	              </div><!-- /.info-box -->
              	</a>
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
            	<a href="{{ route('back.users') }}">
		              <div class="info-box">
		                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
		                <div class="info-box-content">
		                  <span class="info-box-text">Members</span>
		                  <span class="info-box-number">{{ Site::getTotalUsers() }}</span>
		                </div><!-- /.info-box-content -->
		              </div><!-- /.info-box -->
		            </div><!-- /.col -->
		        </a>    
        </div><!-- /.row -->

        <div class="row">
        <div class="col-md-6 col-sm-12">
            {!! CustomerHelper::checkWMUserRevanue3Month() !!}
        </div>
         <div class="col-md-6 col-sm-12">
            {!! CustomerHelper::checkUserNotPurchase2Month() !!}
        </div>

	  <div class="col-md-12">
	    <div class="box">
	      <div class="box-header with-border">
	        <h3 class="box-title">Monthly Sales Report</h3>
	      </div><!-- /.box-header -->
	      <div class="box-body">
	        <div class="row">
	          <div class="col-md-12">
	            <p class="text-center">
	              <strong>Sales: {{ date('01-m-Y') }} to {{ date('d-m-Y') }}</strong>
	            </p>
	            <div class="chart">
	              <!-- Sales Chart Canvas -->
	              <canvas id="salesChart" style="height: 180px;"></canvas>
	            </div><!-- /.chart-responsive -->
	          </div><!-- /.col -->
	      
	        </div><!-- /.row -->
	      </div><!-- ./box-body -->
	      <div class="box-footer">
	        <div class="row">
	          <div class="col-sm-12 col-xs-12">
	            <div class="description-block border-right">
	              <span class="description-percentage text-green"><i class="fa fa-caret-up"></i></span>
	              <h5 class="description-header">{{ PriceHelper::formatPrice(Site::getTotalRevenue()) }}</h5>
	              <span class="description-text">TOTAL REVENUE</span>
	            </div><!-- /.description-block -->
	          </div><!-- /.col -->
	         
	        </div><!-- /.row -->
	      </div><!-- /.box-footer -->
	    </div><!-- /.box -->
	  </div><!-- /.col -->
	</div><!-- /.row -->

	</section>

	
@endsection

@section('footer')
	<!-- ChartJS 1.0.1 -->
    <script src="{{ url('AdminLTE/plugins/chartjs/Chart.min.js') }}"></script>

    <script>
    	$(function () {

    	  'use strict';

    	  /* ChartJS
    	   * -------
    	   * Here we will create a few charts using ChartJS
    	   */

    	  //-----------------------
    	  //- MONTHLY SALES CHART -
    	  //-----------------------

    	  // Get context with jQuery - using jQuery's .get() method.
    	  var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
    	  // This will get the first returned node in the jQuery collection.
    	  var salesChart = new Chart(salesChartCanvas);

    	  var salesChartData = {
    	    labels: ["Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"],
    	    datasets: [
    	      {
    	        label: "Sales",
    	        fillColor: "rgb(0, 166, 90)",
    	        strokeColor: "rgb(0, 166, 90)",
    	        pointColor: "rgb(0, 166, 90)",
    	        pointStrokeColor: "#c1c7d1",
    	        pointHighlightFill: "#fff",
    	        pointHighlightStroke: "rgb(220,220,220)",
    	        data: {!! Site::getDataSalesCurrentWeek() !!}
    	      }
    	    ]
    	  };

    	  var salesChartOptions = {
    	    //Boolean - If we should show the scale at all
    	    showScale: true,
    	    //Boolean - Whether grid lines are shown across the chart
    	    scaleShowGridLines: false,
    	    //String - Colour of the grid lines
    	    scaleGridLineColor: "rgba(0,0,0,.05)",
    	    //Number - Width of the grid lines
    	    scaleGridLineWidth: 1,
    	    //Boolean - Whether to show horizontal lines (except X axis)
    	    scaleShowHorizontalLines: true,
    	    //Boolean - Whether to show vertical lines (except Y axis)
    	    scaleShowVerticalLines: true,
    	    //Boolean - Whether the line is curved between points
    	    bezierCurve: true,
    	    //Number - Tension of the bezier curve between points
    	    bezierCurveTension: 0.3,
    	    //Boolean - Whether to show a dot for each point
    	    pointDot: false,
    	    //Number - Radius of each point dot in pixels
    	    pointDotRadius: 4,
    	    //Number - Pixel width of point dot stroke
    	    pointDotStrokeWidth: 1,
    	    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    	    pointHitDetectionRadius: 20,
    	    //Boolean - Whether to show a stroke for datasets
    	    datasetStroke: true,
    	    //Number - Pixel width of dataset stroke
    	    datasetStrokeWidth: 2,
    	    //Boolean - Whether to fill the dataset with a color
    	    datasetFill: true,
    	    //String - A legend template
    	    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    	    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    	    maintainAspectRatio: true,
    	    //Boolean - whether to make the chart responsive to window resizing
    	    responsive: true
    	  };

    	  //Create the line chart
    	  salesChart.Line(salesChartData, salesChartOptions);
    	});
    </script>
@endsection