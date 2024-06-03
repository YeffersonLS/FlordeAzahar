<?php

namespace App\Http\Controllers;

use App\Models\T12carritoItem;
use App\Models\T13carrito;
use App\Models\T14pedidos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class T14pedidosController extends Controller
{
    public function pay(Request $request){

        $user = auth()->user();
        if (is_null($user)) {

            return redirect('register')->with('mensaje', 'Debe Registrarse para poder finalizar el pedido');

        }

        // dd('se paso');

        $cart = T13carrito::where('t13cliente', auth()->user()->sys01id)->first();

        $cartItems = T12carritoItem::select('t12producto', 't12cantidad', 't12pedido', 't12carrito', 't12carrito', 'p.t04precio', 'p.t04id', 'p.t04nombre')
        ->leftJoin('t04productos as p', 'p.t04id', '=', 't12producto')
        ->whereNot('t12pedido', '=', true)
        ->where('t12carrito', '=', $cart->t13id)->get();

        $total = 0;
        foreach ($cartItems as $cartItem) {
            $check = true;

            $total += $cartItem->t04precio * $cartItem->t12cantidad;
        }


        return view('pago', compact('total'));
    }

    public function payPost(Request $request)
    {
        try {
            $data = $request->all();

            $q = new T14pedidos();
            $q->fill($data);
            $q->t14cliente = Auth::user()->sys01id;
            $q->save();

            $cart = T13carrito::where('t13cliente', auth()->user()->sys01id)->first();

            $cartItems = T12carritoItem::where('t12carrito', '=', $cart->t13id)->get();

            foreach ($cartItems as $cartItem) {
                $cartItem->t12pedido = true;
                $cartItem->t12fechapedido = Carbon::now()->format("Y-m-d");
                $cartItem->save();
            }

            return redirect('/confirmadoco');
        } catch (\Exception $e) {
            // Registrar el error en un log
            dd($e);
            // Log::error('Error en el proceso de pago: ' . $e->getMessage());

            // Mostrar un mensaje de error al usuario
            // return redirect()->back()->withErrors(['error' => 'Ocurrió un error al procesar el pago.']);
        }
    }

}
