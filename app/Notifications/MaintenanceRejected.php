<?php

namespace App\Notifications;

use App\Models\Maintenance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MaintenanceRejected extends Notification
{
    use Queueable;

    public $maintenance;

    public function __construct(Maintenance $maintenance)
    {
        $this->maintenance = $maintenance;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Mantenimiento Rechazado')
            ->line('El mantenimiento realizado fue rechazado por el solicitante.')
            ->line('Máquina: ' . $this->maintenance->machine->name)
            ->line('Descripción: ' . $this->maintenance->description)
            ->action('Ver Detalles', url(route('maintenances.show', $this->maintenance->id)))
            ->line('Por favor, revisa y realiza los ajustes necesarios.');
    }
}
