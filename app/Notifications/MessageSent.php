<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageSent extends Notification
{
    use Queueable;

    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // php artisan vendor:publish --tag=laravel-notifications
        // sent custom template => add view(path, ['data' => $data])

        // return (new CustomMail)->to($notifiable->email)
        return (new MailMessage)
                    ->greeting($notifiable->name. ',')
                    ->error()
                    ->subject('Mensaje recibido desde Notifications web')
                    ->line('Has recibido un mensaje')
                    ->action('Click aquí para ver el mensaje', route('messages.show', $this->message->id))
                    ->line('Gracias por usar nuestra plataforma.');
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
            'link' => route('messages.show', $this->message->id),
            'text' => "Has recibido un mensaje de ".$this->message->sender->name
        ];
    }
}
