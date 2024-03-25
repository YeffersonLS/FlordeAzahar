<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\T02directorio;
use App\Models\T04productos;
use App\Models\T09venta;
use App\Models\User;
use Illuminate\Http\Request;

class T09ventasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Ventas de Flor de Azar';
        $sub = '    <p>Ventas de Heladeria Flor de Azahar.</p>';
        $titulos = T09venta::getTitles();

        return view('datatable', compact('titulo', 'titulos', 'sub'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = 'Crear nueva Venta';
        $clientes = User::orderby('sys01fullname', 'asc')->pluck('sys01fullname', 'sys01id')->toArray();
        $productos = T04productos::orderby('t04nombre', 'asc')->pluck('t04nombre', 't04id')->toArray();
        $registro = new T09venta();
        $pagos = [];
        $formas = T02directorio::where('t02grupo', '=', 'formas_pago')->pluck('t02nombre', 't02id');

        return view('admin.sales.create', compact('titulo', 'clientes', 'registro', 'productos', 'pagos', 'formas'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        dd($data);
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
