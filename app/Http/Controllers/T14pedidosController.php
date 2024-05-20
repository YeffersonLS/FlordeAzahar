<?php

namespace App\Http\Controllers;

use App\Models\T14pedidos;
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
        dd(Auth::user()->sys01id);
        $q = new T14pedidos() ;
        $q->fill($data);
        $q->t14cliente = Auth::user()->sys01id;
    }
}
