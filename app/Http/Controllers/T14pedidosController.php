<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class T14pedidosController extends Controller
{
    public function pay(Request $request){
        // dd($request->all());
        $user = auth()->user();
        if (is_null($user)) {
            dd('no hay usuario');
        }

        dd('se paso');
    }
}
