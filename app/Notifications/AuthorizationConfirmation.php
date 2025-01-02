<?php

 

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AuthorizationConfirmation extends Notification
{
    use Queueable;
    protected $ownerName; 
    public function __construct($ownerName)
    {
        $this->ownerName = $ownerName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmation de votre autorisation pour la collecte des loyers Corps ')
            ->line('Bonjour ' . $this->ownerName . ',')
            ->line('Vous avez autorisé ProPrivy à collecter les loyers en votre nom. Les termes appliqués incluent une commission de 3 % (susceptible de modification selon les CGV). Vous pouvez révoquer cette autorisation à tout moment via votre espace utilisateur. Merci pour votre confiance.')
            ->action('Gérer les autorisations', url('/authorizations'))
 
            ->line("L'équipe ProPrivy");
    }
}

 
  
