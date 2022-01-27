<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExportReady extends Notification
{
    use Queueable;

    public $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }


    public function via($notifiable) : array
    {
        return ['mail'];
    }


    public function toMail($notifiable) : MailMessage
    {
        return (new MailMessage)
                    ->line('Link de descarga.')
                    ->action('Descargar', $this->filePath)
                    ->line('Gracias por usar nuestra applicación!');
    }


    public function toArray($notifiable) : array
    {
        return [
            //
        ];
    }
}
