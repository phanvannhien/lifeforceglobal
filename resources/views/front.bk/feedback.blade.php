@include ('front.includes.header')
@include ('front.nav')
<div class="container main-container headerOffset">
    {!! Breadcrumbs::render('feedback') !!}
    <div class="row innerPage">
        <div class="col-lg-4 col-md-4 col-sm-12">
            Please feedback to Us if you have any prolems.
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <h2>Feedback to Us</h2>
            @include ('front.partials.message')
            <form id="feedback-form" action="{{ route('front.feedback.submit') }}" method="post"
                  class="form form-horizontal">
                <input type="hidden" value="{{csrf_token()}}" name="_token">
                <div class="form-group required">
                    <label for="" class="col-sm-2">Full Name <sub>*</sub></label>
                    <div class="col-sm-10">
                        <input required type="text" class="form-control" name="fullname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2">Email <sub>*</sub></label>
                    <div class="col-sm-10">
                        <input required type="email" class="form-control" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2">Subject <sub>*</sub></label>
                    <div class="col-sm-10">
                        <input required type="text" class="form-control" name="subject">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2">Message <sub>*</sub></label>
                    <div class="col-sm-10">
                        <textarea required name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="g-recaptcha" data-sitekey="6LdY6yMTAAAAAGCtPNCbafSyjvqYe7HF8fNAc5T8"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" name="submit" class="btn btn-primary pull-right">Send</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div style="clear:both"></div>
</div>

<div class="gap"></div>

@section('footer')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
@include ('front.includes.footer')