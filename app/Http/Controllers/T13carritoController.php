<?php

namespace App\Http\Controllers;

use App\Models\T04productos;
use App\Models\T12carritoItem;
use App\Models\T13carrito;
use Illuminate\Http\Request;

class T13carritoController extends Controller
{
    public function addToCart(Request $request) {

        // dd(request()->cookie('flordeazahar_session'));
        $productId = $request->get('t04id');
        $quantity = $request->get('quantity');
        $product = T04productos::FindOrFail($productId);

        $cart = $this->getOrCreateCart();
        // dd($cart, request()->cookie('flordeazahar_session'));

        $cartItem = T12carritoItem::where('t12producto', $productId)
        ->where('t12carrito', '=', $cart->t13id)
        ->where(function ($q) {
            $q->where('t12pedido', '=', false)
            ;
        })
        ->get();

        dd($cartItem);

        if (empty($cartItem)) {
            foreach ($cartItem as $item) {
                if($item->t12producto == $productId){
                    $item->t12cantidad += $quantity;
                    dd($item);
                    $item->update();
                }
            }
        } else {
            $cartItem = new T12carritoItem([
                't12carrito' => $cart->t13id,
                't12producto' => $product->t04id,
                't12cantidad' => $quantity,
            ]);
            $cartItem->save();
        }

        return redirect('producto/'.$product->t04slug)->with('mensaje', 'Se agrego el producto al carrito correctamente');

        // return response()->json(['mensaje' => 'Producto entro al carrito']);

    }

    public function getCart()
    {
        // dd(request()->cookie('flordeazahar_session'));

        $cart = $this->getOrCreateCart();

        $check = false;



        $cartItems = T12carritoItem::select('t12producto', 't12cantidad', 't12pedido', 't12carrito', 't12carrito', 'p.t04precio', 'p.t04id', 'p.t04nombre')
        ->leftJoin('t04productos as p', 'p.t04id', '=', 't12producto')
        ->whereNot('t12pedido', '=', true)
        ->where('t12carrito', '=', $cart->t13id)->get();

        $total = 0;
        foreach ($cartItems as $cartItem) {
            $check = true;

            $total += $cartItem->t04precio * $cartItem->t12cantidad;
        }

        return view('carrito', compact('cartItems', 'total', 'check'));
        // return response()->json([
        //     'cartItems' => $cartItems,
        //     'total' => $total
        // ]);
    }

    public function removeCartItem(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $cartItem = T12carritoItem::where('t12producto', '=', $request->t12producto)
        ->where('t12carrito', '=', $request->t12carrito);
        // dd($cartItem);
        $cartItem->delete();

        return redirect('carrito')->with('mensaje', 'Se elimino el producto correctamente');

        // return response()->json(['mensaje' => 'Elemento eliminado del carrito']);
    }

    private function getOrCreateCart()
    {
        if (auth()->user()) {
            $cart = T13carrito::where('t13cliente', auth()->user()->sys01id)->first();
        } else {
            $sessionId = request()->cookie('flordeazahar_session');
            $cart = T13carrito::where('t13sessionid', $sessionId)->first();
        }

        if (!$cart) {
            $cart = new T13carrito();
            if (auth()->user()) {
                $cart->t13cliente = auth()->user()->sys01id;
            } else {
                $cart->t13sessionid = request()->cookie('flordeazahar_session');
            }
            $cart->save();
        }

        return $cart;
    }

}
