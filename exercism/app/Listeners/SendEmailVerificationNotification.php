<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UserCreated $event)
    {
        Mail::to($event->user->email)->send(new EmailVerification($event->user));
    }
}