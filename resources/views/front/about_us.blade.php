@include ('front.includes.header')
@include ('front.nav')

<div class="container main-container headerOffset">
	<div class="row innerPage">
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h3 class="title"><span class="d-inline">OUR MISSION</span> </h3>
			<blockquote class="blockquote">
				Rediscover the happier and healthier you
			</blockquote>
			<h3 class="title"><span class="d-inline">ABOUT US?</span> </h3>
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 s-text">
					{!! Site::getConfig('aboutus') !!}
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<h4>Join us today and see the difference for yourself.</h4>
				</div>
			</div>


		</div>
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<img class="img-fluid" src="{{url('images/aboutus.png')}}" alt="">
		</div>
	</div>
 
<div style="clear:both"></div>
</div>
 
<div class="gap"></div>


@include ('front.includes.footer')