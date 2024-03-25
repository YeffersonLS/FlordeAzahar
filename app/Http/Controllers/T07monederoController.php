<?php

namespace App\Http\Controllers;

use App\Models\T07monedero;
use App\Models\T08detallemonedero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class T07monederoController extends Controller
{
    public static $ruta ='/monedero';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check()) {
            $monedero = T07monedero::where('t07usuario', '=', auth()->user()->sys01id)->first();

            if (!is_null($monedero)) {
                $total = 0;
                $cargos = T08detallemonedero::where('t08monedero', '=', $monedero->t07id)->get();
                if (!$cargos->isEmpty()) {
                    foreach ($cargos as $cargo) {
                        $total += $cargo->t08valor;
                    }
                }
                return view('pocketbook.home', compact('monedero', 'cargos', 'total'));
            } else {
                return view('pocketbook.create');
            }
        } else {
            return view('pocketbook.register');
        }



    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $c = new T07monedero();
        $data = [
            't07usuario' => Auth::user()->sys01id
        ];
        $c->fill($data);
        $c->save();

        return redirect(self::$ruta)->with('mensaje', 'Se creo el monedero correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
