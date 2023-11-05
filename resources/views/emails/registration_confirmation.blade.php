@php
    $url = admin_url('/auth/setting');
    $siteName = config('app.name'); // Utilisez le nom de votre site
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>Bienvenue sur {{ $siteName }}</title>
</head>

<body>
    <p>Bonjour {{ $username }},</p>
    <p>Bienvenue dans le Système National de Traçabilité et de Suivi des Semences ! Votre inscription a été un succès.</p>
    <p>Utilisez <strong>{{ $username }}</strong> comme nom d'utilisateur et <strong>{{ $password }}</strong> comme mot de passe pour vous connecter.</p>
    <p>Merci de nous rejoindre ! <a href="{{ $url }}">Cliquez ici</a> pour accéder à vos paramètres de compte.</p>
    <p>Si vous avez des questions ou besoin d'aide, n'hésitez pas à <a href="{{ $url }}">nous contacter</a>.</p>
    <p>Cordialement,<br> L'équipe {{ $siteName }}</p>
</body>

</html>

