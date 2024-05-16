<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class T14pedidosController extends Controller
{
    public function pay(Request $request){
        dd($request->all());
    }
}
