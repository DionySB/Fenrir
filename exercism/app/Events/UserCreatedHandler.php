<?php

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserCreatedHandler implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UserCreated $event)
    {
        $user = $event->getUser();

        // Send email verification notification to the user
        $user->sendEmailVerificationNotification();
    }
}