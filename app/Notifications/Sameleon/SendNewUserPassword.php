<?php

namespace App\Notifications\Sameleon;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class SendNewUserPassword extends Notification
{
    use Queueable;

    public $password;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
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
        $url = url(route('admin:auth:login', [
            'token' => Str::random(9),
        ], false));

        return (new MailMessage)
            ->subject(Lang::get('Sameleon Express'))
            ->line(Lang::get('Bienvenue !'))
            ->line(Lang::get("Vote mot de pass : $this->password "))
            ->line(Lang::get("Vote E-mail : $notifiable->email "))
            ->action(Lang::get('Se connecter'), $url)
            ->line(Lang::get('If you did not request a password reset, no further action is required.'));
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
            //
        ];
    }
}
