@php $url = admin_url() @endphp
<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Our Website</title>
</head>

<body>
    <p>Hello {{ $username }},</p>
    <p>Welcome to our website! Your registration was successful.</p>
    <p>Use {{ $username }} as your username and {{ $password }} as your password to login</p>
    <p>Thank you for joining us! <a href="{{ $url }}">Click Here</a></p>
</body>

</html>