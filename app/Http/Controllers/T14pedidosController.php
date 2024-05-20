<?php

namespace App\Http\Controllers;

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


    }
}
