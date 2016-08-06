
<p class="clearfix"></p>
<footer>
   <div class="footer">

   </div>
   <div class="footer-bottom">
      <div class="container">
          <div class="row">
              <div class="col-sm-12">
                  <p class="pull-left text-copyright"> &copy; 2016, Lifeforce Global . All right reserved. </p>
                  <p class="pull-right">
                      <a href="{{ Site::getConfig('facebook_url') }}"><img src="{{url('images/fb.png')}}" alt=""> </a>
                      <a href="{{ Site::getConfig('google_url') }}"><img src="{{url('images/tw.png')}}" alt=""> </a>
                      <a href="{{ Site::getConfig('pinterest_url') }}"><img src="{{url('images/pt.png')}}" alt=""> </a>
                  </p>
              </div>
          </div>

      </div>
   </div>
</footer>
</div> <!--end page site -->
@include('front.partials.cart')
@include('front.partials.navbar-mobile')
<div id="loading" style="display: none">
    <img src="{{url('images/loading.gif')}}" alt="">
</div>


<script src="{{ url('assets/app.min.js') }}"></script>

<script type="text/javascript" src="{{ url('assets/js/parallax.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/helper-plugins/jquery.mousewheel.min.js') }}"></script>

<script src="{{ url('assets/plugins/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ url('assets/plugins/jquery-validate/additional-methods.min.js') }}"></script>

<script src="{{ url('assets/plugins/slidebars/dist/slidebars.min.js') }}"></script>
<link href="{{ url('assets/plugins/slidebars/dist/slidebars.min.css') }}" rel="stylesheet" type="text/css"/>


<!--
<script src="{{ url('assets/js/script.js') }}"></script>
-->

<script src="{{ url('assets/js/footable.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/footable.sortable.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/site.js') }}"></script>
<script src="{{ url('assets/main.js') }}"></script>
@yield('footer')
</html>