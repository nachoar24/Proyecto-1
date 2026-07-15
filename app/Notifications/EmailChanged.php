<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailChanged extends Notification
{
    public function __construct(
        public User $user,
        public string $originalEmail,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('El correo electrónico de tu cuenta fue actualizado')
            ->greeting('Hola, '.$this->user->name)
            ->line('El correo electrónico asociado con tu cuenta fue actualizado.')
            ->line('Nuevo correo electrónico: '.$this->user->email)
            ->line('Si realizaste este cambio, no necesitas hacer nada.')
            ->line('Si no reconoces este cambio, contacta al soporte lo antes posible.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'original_email' => $this->originalEmail,
            'new_email' => $this->user->email,
        ];
    }
}
