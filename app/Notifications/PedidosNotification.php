<?php

namespace App\Notifications;

use App\Models\T04productos;
use App\Models\T12carritoItem;
use App\Models\T13carrito;
use App\Models\T14pedidos;
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


        $name = $user->sys01fullname;

        $cart = T13carrito::where('t13cliente', auth()->user()->sys01id)->first();

        $pedido = T14pedidos::where('t14cliente', auth()->user()->sys01id)->orderBy('t14id', 'desc')->first();

        $pago = $pedido->t14tipopago;

        $direccion = $pedido->t14direccion;
        // dd($pago);

        $cartItems = T12carritoItem::where('t12carrito', '=', $cart->t13id)
        ->where(function ($q) {
            $q->where('t12correo', '=', false)
            ->where('t12fechapedido', '=', Carbon::now()->format("Y-m-d"))
            ;
        })
        ->get();

        // dump($cartItems);

        $productNames = '';
        foreach ($cartItems as $item) {
            $producto = T04productos::findOrFail($item->t12producto);
            $productName = $producto->t04nombre;
            $quantity = $item->t12cantidad;

            // Concatenar nombre del producto y cantidad
            $productNames .= "$productName (x$quantity), ";

            $item->t12correo = true;
            $item->save();
        }

        $combinedProductNames = rtrim($productNames, ', ');
        // dump($combinedProductNames);


        return (new MailMessage)
                    ->line('El cliente '."$name")
                    ->line('Acaba de realizar un compra en Heladeria Flor de Azahar por la pagina web. la cual realizara el pago por medio de '."$pago")
                    ->action('Este es el numero de telefono', url("$url"))
                    ->line('Dado caso no responda este es el telefono que registro '."$phone")
                    ->line('Estos son los productos ordenados')
                    ->line("$combinedProductNames")
                    ->line('Esta es la dirección de entrega:')
                    ->line("$direccion")
                    ->cc('yefferson.mod@gmail.com')
                    ->cc('linaloaizasol@gmail.com');
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
