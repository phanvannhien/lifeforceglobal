<h4>Hello {{ $email }}</h4>
<h2>Your account at: {{ config('app.sitename') }}</h2>
<p>Your email: {{ $email }}</p>
<p>Your code: {{ $user_code }}</p>
<p><a href="{{ route('user.verify',$user_verify_code) }}">Click here to verify your account</a></p>