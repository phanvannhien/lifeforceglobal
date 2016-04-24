<h4>Hello {{ $mail['email'] }}</h4>
<h2>Your account at: {{ config('app.sitename') }}</h2>
<p>Your email: {{ $mail['email'] }}</p>
<p>Your code: {{ $mail['user_code'] }}</p>

<p>Please payment to active your account:</p>
<h2>Payment infomations</h2>
{!! Site::getConfig('bank') !!}
