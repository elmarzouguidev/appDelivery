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
            ->subject(Lang::get('Sameleon-Express'))
            ->line(Lang::get("Bienvenue $notifiable->full_name !"))
            ->line(Lang::get("Votre mot de pass : $this->password "))
            ->line(Lang::get("Votre E-mail : $notifiable->email "))
            ->line(Lang::get("Merci pour votre confiance "))
            ->lin(Lang::get("Pour la  connection a l'application veuillez utiliser le lien suivant"))
            ->action(Lang::get('Se connecter'), $url)
  
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
