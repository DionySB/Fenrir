@component('mail::message')
# Verifique seu e-mail

Clique no botão abaixo para verificar seu endereço de e-mail.

@component('mail::button', ['url' => route('verify.email', ['id' => $user->id, 'hash' => $user->email_verification_hash])])
Verificar e-mail
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent