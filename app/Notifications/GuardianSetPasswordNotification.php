<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GuardianSetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $token,
        public User $applicant,
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
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->email,
        ], false));

        return (new MailMessage)
            ->subject('Set Your Password — HDWSI Guardian Account')
            ->greeting("Hello {$notifiable->first_name},")
            ->line("{$this->applicant->name} has listed you as their guardian for an HDWSI admission application.")
            ->line('Since this is your first time signing in, please set a password for your new guardian account below.')
            ->action('Set Password', $url)
            ->line('Once your password is set, you can log in and review the consent request we sent in a separate email.')
            ->line('This link will expire in 60 minutes. If you did not expect this email, no action is needed.');
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
