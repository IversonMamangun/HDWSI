<?php

namespace App\Listeners;

use App\Events\GuardianConsentRequested;
use App\Notifications\GuardianConsentRequestNotification;
use App\Notifications\GuardianSetPasswordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Password;

class SendGuardianConsentNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(GuardianConsentRequested $event): void
    {
        $event->guardian->notify(
            new GuardianConsentRequestNotification($event->applicant, $event->isNewGuardian)
        );

        if ($event->isNewGuardian) {
            $token = Password::createToken($event->guardian);

            $event->guardian->notify(
                new GuardianSetPasswordNotification($token, $event->applicant)
            );
        }
    }
}
