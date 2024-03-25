<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\m;
use App\Models\T05postProductos;
use Illuminate\Http\Request;

class t05postProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Post de los Productos';
        $sub = '<p>Estas son los Productos que hay de flor de azahar.</p>';
        $titulos = T05postProductos::getTitles();
        return view('datatable', compact('titulo', 'titulos', 'sub'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        T05postProductos::find($id)->delete();

        // return redirect(self::$ruta)->with('mensaje', 'Se ha eliminado la etiqueta correctamente!');
    }
}
