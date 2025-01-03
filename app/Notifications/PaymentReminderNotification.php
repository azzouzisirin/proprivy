<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentReminderNotification extends Notification
{
    use Queueable;

    public $dueDate;
    public $property;

    public function __construct($dueDate, $property)
    {
        $this->dueDate = $dueDate;
        $this->property = $property;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Upcoming Rent Payment Reminder')
            ->line('This is a reminder that the rent for the property: ' . $this->property . ' is due soon.')
            ->line('Due Date: ' . $this->dueDate)
            ->action('View Details', url('/dashboard'))
            ->line('Thank you for using ProPrivy!');
    }
}