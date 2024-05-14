<?php

namespace App\Http\Controllers;

use App\Models\T04productos;
use App\Models\T12carritoItem;
use App\Models\T13carrito;
use Illuminate\Http\Request;

class T13carritoController extends Controller
{
    public function addToCart(Request $request) {

        // dd($request->all());
        $productId = $request->get('t04id');
        $quantity = $request->get('quantity');

        $cart = $this->getOrCreateCart();
        // dd($cart);

        $cartItem = $cart->cartItems()->where('t12producto', $productId)->first();

        dd($cartItem);

        if ($cartItem) {
            $cartItem->quantity += $quantity;
        } else {
            $product = T04productos::findOrFail($productId);
            $cartItem = new T12carritoItem([
                't12carrito' => $cart->t13id,
                't12producto' => $product->t04id,
                't12cantidad' => $quantity,
            ]);
            $cart->cartItems()->save($cartItem);
        }

        return response()->json(['mensaje' => 'Producto entro al carrito']);

    }

    public function getCart()
    {
        $cart = $this->getOrCreateCart();

        // $cartItems = $cart->cartItems()->with('t12producto')->get();


        // $cartItems = $cart->cartItems()->where('t12carrito', '=', $cart->t13id)->get();

        $cartItems = T12carritoItem::where('t12carrito', '=', $cart->t13id)->get();
        dd($cartItems);

        $total = 0;
        foreach ($cartItems as $cartItem) {
            $query = T04productos::findOrFail($cartItem->t12producto);

            $total += $query->t04precio * $cartItem->t12cantidad;
        }

        return response()->json([
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    public function removeCartItem($cartItemId)
    {
        $cartItem = T12carritoItem::findOrFail($cartItemId);
        $cartItem->delete();

        return response()->json(['mensaje' => 'Elemento eliminado del carrito']);
    }

    private function getOrCreateCart()
    {
        if (auth()->user()) {
            $cart = T13carrito::where('t13cliente', auth()->user()->sys01id)->first();
        } else {
            $sessionId = request()->cookie('laravel_session');
            $cart = T13carrito::where('t13sessionid', $sessionId)->first();
        }

        if (!$cart) {
            $cart = new T13carrito();
            if (auth()->user()) {
                $cart->t13cliente = auth()->user()->sys01id;
            } else {
                $cart->t13sessionid = request()->cookie('laravel_session');
            }
            $cart->save();
        }

        return $cart;
    }

}
