<h1>Hello {{ $user->first_name }}</h1>
<p>
    Please click the password reset button to reset your password
    <a href="{{ url('api/reset_password').'/'.$user->email.'/'.$code }}">Reset Password</a>
</p> 