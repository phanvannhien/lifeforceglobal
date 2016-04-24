<p>Dear,</p>
<br>
<p>Hello, {{ $user->email }}</p>
<p>Your account verified. Welcome to {{ config('app.sitename') }}</p>
<p><a href="{{ route('front.index') }}">Go to {{ config('app.sitename') }} </a></p>
<br>
<hr>
<p>Best.</p>	