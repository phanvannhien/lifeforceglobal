<footer>
   <div class="footer">
      <div class="container">
         <div class="row">
            <div class="col-lg-3  col-md-3 col-sm-4 col-xs-6">
               <h3> Contact Us </h3>
               <ul>
                  <li class="supportLi">
                     <h4>
                        <a class="inline" href="">
                           <i class="fa fa-envelope-o"> </i>
                           <span> info@lifeforceglobal.com.au</span>
                           
                        </a>
                     </h4>
                  </li>
               </ul>
            </div>
            <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
               <h3> Shop </h3>
               <ul>
                  <li><a href="">
                     Products
                     </a>
                  </li>
               </ul>
            </div>
            <div style="clear:both" class="hide visible-xs"></div>
            <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
               <h3> Information </h3>
               <ul class="list-unstyled footer-nav">
                  <li><a href="{{ route('front.aboutus') }}"> About Us
                     </a>
                  </li>
               </ul>
            </div>
            <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
               <h3> My Account </h3>
               <ul>
                  <li><a href="#"> My Account </a></li>
                  <!--
                  <li><a href="#"> My Address </a></li>
                  <li><a href="#"> Wish List </a></li>
                  <li><a href="#"> Order list </a></li>
                  <li><a href="#"> Order Status </a></li>-->
               </ul>
            </div>
            <div style="clear:both" class="hide visible-xs"></div>
            <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
               <h3> Stay in touch </h3>
               <!--
               <ul>
                  <li>
                     <div class="input-append newsLatterBox text-center">
                        <input type="text" class="full text-center" placeholder="Email ">
                        <button class="btn  bg-gray" type="button"> Subscribe <i class="fa fa-long-arrow-right"> </i></button>
                     </div>
                  </li>
               </ul>
               -->
               <ul class="social">
                  <li><a href="http://facebook.com"> <i class=" fa fa-facebook"> &nbsp; </i> </a></li>
                  <li><a href="http://twitter.com"> <i class="fa fa-twitter"> &nbsp; </i> </a></li>
                  <li><a href="https://plus.google.com"> <i class="fa fa-google-plus"> &nbsp; </i> </a></li>
                  <li><a href="http://youtube.com"> <i class="fa fa-pinterest"> &nbsp; </i> </a></li>
                  <li><a href="http://youtube.com"> <i class="fa fa-youtube"> &nbsp; </i> </a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="footer-bottom">
      <div class="container">
         <p class="pull-left"> &copy; lifeforce Global 2016. All right reserved. </p>
         <!--
         <div class="pull-right paymentMethodImg">
         	<img height="30" class="pull-right" src="{{ url('images/site/payment/master_card.png') }}" alt="img">
         	<img height="30" class="pull-right" src="{{ url('images/site/payment/visa_card.png') }}" alt="img">
         	<img height="30" class="pull-right" src="{{ url('images/site/payment/paypal.png') }}" alt="img">
            <img height="30" class="pull-right" src="{{ url('images/site/payment/american_express_card.png') }}" alt="img">
            <img height="30" class="pull-right" src="{{ url('images/site/payment/discover_network_card.png') }}" alt="img">
            <img height="30" class="pull-right" src="{{ url('images/site/payment/google_wallet.png') }}" alt="img">
         </div>-->
      </div>
   </div>
</footer>
<div class="modal fade hide" id="modalAds" role="dialog">
   <div class="modal-dialog  modal-bg-1">
      <div class="modal-body-content">
         <a class="close" data-dismiss="modal">×</a>
         <div class="modal-body">
            <div class="col-lg-6 col-sm-8 col-xs-8">
               <h3>enter your <br>email to receive</h3>
               <p class="discountLg">10% OFF </p>
               <p>We invite you to subscribe to our newsletter and receive 10% discount.</p>
               <div class="clearfx">
                  <form id="newsletter" class="newsletter">
                     <input type="text" id="subscribe" name="s" placeholder="Enter email">
                     <button class="subscribe-btn">Subscribe</button>
                  </form>
               </div>
               <p><a href="category.html" class="link shoplink"> SHOP NOW <i class="fa fa-caret-right"> </i> </a></p>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="{{ url('assets/js/jquery/jquery-1.10.1.min.js') }}"></script>
<script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script>
   /* this script required for subscribe modal
   $(window).load(function () {
       // full load
       $('#modalAds').modal('show');
       $('#modalAds').removeClass('hide');
   });
   */
</script>
<script src="{{ url('assets/js/jquery.cycle2.min.js') }}"></script>
<script src="{{ url('assets/js/jquery.easing.1.3.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/jquery.parallax-1.1.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/helper-plugins/jquery.mousewheel.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/jquery.mCustomScrollbar.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/icheck-1.x/icheck.min.js') }}"></script>
<script src="{{ url('assets/js/grids.js') }}"></script>
<script src="{{ url('assets/js/owl.carousel.min.js') }}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="{{ url('assets/js/bootstrap.touchspin.js') }}"></script>


<script src="{{ url('assets/plugins/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ url('assets/plugins/jquery-validate/additional-methods.min.js') }}"></script>


<script src="{{ url('assets/js/home.js') }}"></script>
<script src="{{ url('assets/js/script.js') }}"></script>
<script src="{{ url('assets/js/site.js') }}"></script>
<script></script>
<script type="text/javascript">/* <![CDATA[ */(function(d,s,a,i,j,r,l,m,t){try{l=d.getElementsByTagName('a');t=d.createElement('textarea');for(i=0;l.length-i;i++){try{a=l[i].href;s=a.indexOf('/cdn-cgi/l/email-protection');m=a.length;if(a&&s>-1&&m>28){j=28+s;s='';if(j<m){r='0x'+a.substr(j,2)|0;for(j+=2;j<m&&a.charAt(j)!='X';j+=2)s+='%'+('0'+('0x'+a.substr(j,2)^r).toString(16)).slice(-2);j++;s=decodeURIComponent(s)+a.substr(j,m-j)}t.innerHTML=s.replace(/</g,'&lt;').replace(/>/g,'&gt;');l[i].href='mailto:'+t.value}}catch(e){}}}catch(e){}})(document);/* ]]> */</script></body>
</html>