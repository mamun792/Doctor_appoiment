<x-mail::message>
#  Congratulations to {{$information['name']}}!

Your account has been created DPLC.com


<x-mail::panel>
    <p>Email: </br> {{$information['email']}} </p>
    <p>Password: </br> {{$information['password']}} </p>
<br>
    <h2>Role:  {{$information['role']}} </h2>
</x-mail::panel>
<p>You can change password by login into your Account</p>


<x-mail::button :url="url('login')" color="success">
    Click to login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>
<body>
    <h1 style="background: red">Congratulations!</h1>
    <h3>Hello, {{$information['name']}}</h3>
    <p>Account has create at DPLCM.com</p>
    <p><br>Email: </br> {{$information['email']}} </p>
    <p><br>Password: </br> {{$information['password']}} </p>
    <p>You can change password by login into your Account</p>
    <p>
    <a href="{{url('login')}}">Click to login</a>
    </p>
    <h2>Role:  {{$information['role']}} </h2>
</body>
</html>
 --}}
