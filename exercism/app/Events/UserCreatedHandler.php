<?php

namespace App\Handlers\Events;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\EmailVerificationService;

class UserCreatedHandler
{
    private $emailVerificationService;

    public function __construct(EmailVerificationService $emailVerificationService)
    {
        $this->emailVerificationService = $emailVerificationService;
    }

    public function handle(UserCreated $event)
    {
        $user = $event->getUser();
        $this->emailVerificationService->sendVerificationEmail($user);
    }
}