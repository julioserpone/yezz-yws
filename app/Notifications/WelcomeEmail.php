<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeEmail extends Notification
{
    use Queueable;

    private $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message_email = explode("{LF}", $this->data['message_email']);

        return (new MailMessage)
                    ->subject(trans('email.user.welcome', ['username' => $this->data['username']]))
                    ->greeting(trans('email.dear_customer'))
                    ->line($message_email[0])
                    ->line($message_email[1])
                    ->line(str_replace('{USER}', $this->data['username'], $message_email[2]))
                    ->line(str_replace('{PASSWORD}', $this->data['password'], $message_email[3]))
                    ->line($message_email[4])
                    ->line($message_email[5])
                    ->action(trans('email.sign_now'), env('APP_URL'))
                    ->line(trans('email.thanks'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'data' => $this->data
        ];
    }
}
