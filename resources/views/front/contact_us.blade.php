@include ('front.includes.header')
@include ('front.nav')

<div class="container main-container contact-us">
   <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
         <h3 class="title"><span class="d-inline">MAKE AN APPOINTMENT</span></h3>
         @include ('front.partials.message')
         <form id="feedback-form" action="{{ route('front.contactus.post') }}" method="post"
               class="form form-horizontal">
            <input type="hidden" value="{{csrf_token()}}" name="_token">
            <div class="form-group required">
                  <input required type="text" class="form-control" name="fullname" placeholder="Name">
            </div>
            <div class="form-group">
               <input required type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
               <input required type="text" class="form-control" name="subject" placeholder="Subject">
            </div>
            <div class="form-group">
               <textarea style="height: 120px" required name="message" id="" cols="30" rows="10" class="form-control" placeholder="Mesage"></textarea>
            </div>
           
            <div class="form-group">
               <button type="submit" name="submit" class="btn btn-primary pull-right">Send</button>
            </div>
         </form>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
         <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
               {!! Site::getConfig('contact') !!}
              
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
               <p class="large-text text-muted">
                  WE MIGHT BE ABLE TO ANSWER YOUR QUESTIONS RIGHT NOW, CHECK OUT
                  OUR <a href="#">FAQ's</a>
               </p>
            </div>
         </div>
      </div>
   </div>
   <div class="text-xs-center">
      <p>&nbsp;</p>
      <img src="{{ url('images/contact-us.gif') }}" alt="">
   </div>
</div>

@include ('front.includes.footer')