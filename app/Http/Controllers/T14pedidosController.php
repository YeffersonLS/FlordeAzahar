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

        return view('pago');
    }

    public function payPost(Request $request){

        $data = $request->all();
        // dd(Auth::user()->sys01id);
        $q = new T14pedidos() ;
        $q->fill($data);
        $q->t14cliente = Auth::user()->sys01id;
        // $q->save();

        $cart = T13carrito::where('t13cliente', auth()->user()->sys01id)->first();


        $cartItems = T12carritoItem::select('t12producto', 't12cantidad', 't12carrito', 't12pedido', 't12fechapedido')
        ->where('t12carrito', '=', $cart->t13id)->get();

        // dd($cartItems);

        foreach ($cartItems as $cartItem) {
            $cartItem->t12pedido = true;
            $cartItem->t12fechapedido = Carbon::now()->format("Y-m-d");
            dd($cartItem);
            $cartItem->update();


        }

        return redirect('/confirmadoco');

    }
}
