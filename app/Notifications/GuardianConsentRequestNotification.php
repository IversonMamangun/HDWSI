<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class GuardianConsentRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public User $applicant,
        public bool $isNewGuardian = false,
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = URL::temporarySignedRoute(
            'guardian.consent.show',
            now()->addDays(7),
            ['applicant' => $this->applicant->id],
        );

        $mail = (new MailMessage)
            ->subject('Guardian Consent Required — HDWSI Admission')
            ->greeting("Hello {$notifiable->first_name},")
            ->line("{$this->applicant->name} has registered as an applicant and listed you as their guardian.")
            ->line('Before their application can be submitted, we need your consent.');

        if ($this->isNewGuardian) {
            $mail->line("Since this is your first time here, we've also sent a separate email so you can set up a password and log in to your new guardian account.");
        }

        return $mail
            ->action('Review & Give Consent', $url)
            ->line('This link expires in 7 days.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
