@php
    $url = admin_url('/auth/setting');
    $siteName = config('app.name'); // Use your site's name
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>Welcome to {{ $siteName }}</title>
</head>

<body>
    <p>Hello {{ $username }},</p>
    <p>Welcome to the National Seed Tracing and Tracking System! Your registration was successful.</p>
    <p>Use <strong>{{ $username }}</strong> as your username and <strong>{{ $password }}</strong> as your password to log in.</p>
    <p>Thank you for joining us! <a href="{{ $url }}">Click here</a> to visit your account settings.</p>
    <p>If you have any questions or need assistance, please don't hesitate to <a href="{{ $url }}">contact us</a>.</p>
    <p>Best regards,<br>{{ $siteName }} Team</p>
</body>

</html>
