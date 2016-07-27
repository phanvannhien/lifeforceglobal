
<p class="clearfix"></p>
<footer>
   <div class="footer">

   </div>
   <div class="footer-bottom">
      <div class="container">
          <div class="row">
              <div class="col-sm-12">
                  <p class="pull-left text-copyright"> &copy; lifeforce Global 2016. All right reserved. </p>
                  <p class="pull-right">
                      <a href="/" href="{{ url('/faccebook') }}"><img src="{{url('images/fb.png')}}" alt=""> </a>
                      <a href="/" href="{{ url('/faccebook') }}"><img src="{{url('images/tw.png')}}" alt=""> </a>
                      <a href="/" href="{{ url('/faccebook') }}"><img src="{{url('images/pt.png')}}" alt=""> </a>
                  </p>
              </div>
          </div>

      </div>
   </div>
</footer>

<script src="{{ url('assets/app.min.js') }}"></script>
<script>
   /* this script required for subscribe modal
   $(window).load(function () {
       // full load
       $('#modalAds').modal('show');
       $('#modalAds').removeClass('hide');
   });
   */
</script>

<script type="text/javascript" src="{{ url('assets/js/jquery.parallax-1.1.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/helper-plugins/jquery.mousewheel.min.js') }}"></script>



<script src="{{ url('assets/plugins/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ url('assets/plugins/jquery-validate/additional-methods.min.js') }}"></script>


<script src="{{ url('assets/js/home.js') }}"></script>
<script src="{{ url('assets/js/script.js') }}"></script>
<script src="{{ url('assets/js/site.js') }}"></script>

<script src="{{ url('assets/js/footable.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/footable.sortable.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $('.footable').footable();
    });
</script>
<div id="loading" style="display: none">
    <img src="{{url('images/loading.gif')}}" alt="">
</div>
<script>
    $.ajaxSetup({
        beforeSend: function() {
            $('#loading').fadeIn();
        },
        complete: function() {
            $('#loading').fadeOut();
        },
        success: function() {
            $('#loading').fadeOut();
        }
    });
</script>
@yield('footer')
</html>