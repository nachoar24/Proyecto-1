<?php

namespace App\Notifications;

use App\Models\Idea;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class IdeaPublished extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Idea $idea)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nueva idea publicada')
            ->greeting('Hola, ' . $notifiable->name)
            ->line('Publicaste una nueva idea:')
            ->line($this->idea->description)
            ->action('Leer idea', url('/ideas/' . $this->idea->id))
            ->line('Gracias por usar la aplicación.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'idea_id' => $this->idea->id,
            'description' => $this->idea->description,
        ];
    }
}