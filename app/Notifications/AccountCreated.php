<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class AccountCreated extends Notification
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $redirect;

    /**
     * AccountedCreated constructor.
     * 
     * @param User $user
     *
     * @return void
     */
    public function __construct(User $user, $redirect)
    {
        $this->user = $user;
        $this->redirect = $redirect;
    }

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
        return (new MailMessage)
            ->subject('Sua conta foi criada com sucesso!')
            ->greeting('Olá, ' . $this->user->name)
            ->line('Sua conta foi criada.')
            ->action('Acesse este endereco para valida-la', $this->redirect)
            ->line('Obrigado por usar nosso sistema!')
            ->salutation('Atenciosamente,');
    }
}