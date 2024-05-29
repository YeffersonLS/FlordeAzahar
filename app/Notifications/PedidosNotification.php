<?php

namespace App\Notifications;

use App\Models\T04productos;
use App\Models\T12carritoItem;
use App\Models\T13carrito;
use App\Models\User;
use Carbon\Carbon;
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

        $cart = T13carrito::where('t13cliente', auth()->user()->sys01id)->first();

        $cartItems = T12carritoItem::select('t12producto', 't12cantidad', 't12carrito', 't12pedido')
        ->where('t12carrito', '=', $cart->t13id)
        ->where('t12pedido', '=', 1)
        ->where('t12fechapedido', '=', Carbon::now()->format("Y-m-d"))
        ->get();

        dump($cartItems);

        $productNames = '';
        foreach ($cartItems as $item) {
            $producto = T04productos::findOrFail($item->t12producto);
            $productName = $producto->t04nombre;

            $productNames .= $productName . ', ';
        }

        $combinedProductNames = rtrim($productNames, ', ');
        dump($combinedProductNames);

        return (new MailMessage)
                    ->line('Acaban de realizar un compra en Heladeria Flor de Azahar por la pagina web.')
                    ->action('Este es el numero de telefono', url("$url"))
                    ->line('Dado caso no responda este es el telefono que registro '."$phone")
                    ->line('Estos son los productos ordenados')
                    ->line("$combinedProductNames");
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
