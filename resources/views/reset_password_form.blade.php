<h2>Reset Password</h2>
<h2>{{ $user->email }}</h2>

<form action="{{ url('api/reset_password').'/'.$user->email.'/'.$code }}" method="post">
    {{ csrf_field() }}
    
    Password:<br>
    <input type="password" name="password" id="password">
    
    <br><br>
     Confirm Password:<br>
    <input type="password" name="c_password" name="c_password" id="c_password">

    <br><br>

    <button type="submit">Reset Password</button>
    
</form>