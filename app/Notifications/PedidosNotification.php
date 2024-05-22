<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class PedidosNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $user = User::FindOrFail(Auth::user()->sys01id);

        $url = 'https://api.whatsapp.com/send?phone=521'. "$user->sys01phonenumber";

        $phone = $user->sys01phonenumber;

        return (new MailMessage)
                    ->line('Acaban de realizar un compra en Heladeria Flor de Azahar por la pagina web.')
                    ->action('Este es el numero de telefono', url("$url"))
                    ->line('Dado caso no responda este es el telefono que registro'."$phone");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
