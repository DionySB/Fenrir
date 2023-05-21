<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Events\UserRegistered;
use App\Notifications\CustomVerifyEmailNotification;

class SendEmailVerificationNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UserRegistered $event)
    {
        $event->user->sendEmailVerificationNotification();
    }
}