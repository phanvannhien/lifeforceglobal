<h4>Hello {{ $mail['email'] }}</h4>
<h2>Your account at: {{ config('app.sitename') }}</h2>
<p>Your email: {{ $mail['email'] }}</p>
<p>Your code: {{ $mail['user_code'] }}</p>
<p><a href="{{ route('user.verify',$mail['user_verify_code']) }}">Click here to verify your account</a></p>