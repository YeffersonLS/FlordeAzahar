<?php

namespace App\Http\Controllers;

use App\Models\T04productos;
use App\Models\T12carritoItem;
use App\Models\T13carrito;
use Illuminate\Http\Request;

class T13carritoController extends Controller
{
    public function addToCart(Request $request) {

        dd($request->all());
        $productId = $request->get('product_id');
        $quantity = $request->get('quantity');

        dd($quantity);

        $cart = $this->getOrCreateCart();

        $cartItem = $cart->cartItems()->where('t12producto', $productId)->first();


        if ($cartItem) {
            $cartItem->quantity += $quantity;
        } else {
            $product = T04productos::findOrFail($productId);
            $cartItem = new T12carritoItem([
                't12producto' => $product->t04id,
                't12cantidad' => $quantity,
            ]);
            $cart->cartItems()->save($cartItem);
        }

        return response()->json(['mensaje' => 'Producto añadido al carrito']);

    }

    public function getCart()
    {
        $cart = $this->getOrCreateCart();
        $cartItems = $cart->cartItems()->with('t12producto')->get();

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
