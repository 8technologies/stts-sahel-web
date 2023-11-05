@component('mail::message')
# Bonjour

<p>{{$message}}</p>

@component('mail::button', ['url' => $link, 'color' => 'green', ])
Voir le formulaire
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
