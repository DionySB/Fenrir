<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmailNotification extends VerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verificação de email')
            ->line('Por favor, clique no botão abaixo para verificar seu endereço de email.')
            ->action('Verificar Email', $verificationUrl)
            ->line('Se não foi você quem criou a conta, por favor, desconsidere o email');
    }

    protected function verificationUrl($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        return str_replace(url('/api'), config('app.client_url'), $url);
    }
}
