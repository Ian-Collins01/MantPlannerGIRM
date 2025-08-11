<?php

namespace App\Notifications;

use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MaintenanceCreated extends Notification
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
            ->subject('Mantenimiento Creado')
            ->greeting('Hola ' . $notifiable->name)
            ->line('Se ha creado un nuevo mantenimiento.')
            ->line('Máquina: ' . $this->maintenance->machine->name)
            ->line('Descripción: ' . $this->maintenance->description)
            ->action('Ver mantenimiento', route('maintenances.show', $this->maintenance))
            ->line('Por favor revisa y asígnalo a un técnico disponible.');
    }
}
