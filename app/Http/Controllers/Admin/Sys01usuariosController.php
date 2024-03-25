<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Sys01usuariosController extends Controller
{
    public static $ruta = 'admin/user';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Usuarios';
        $sub = '    <p>Estos son los blogs que hay de flor de azahar.</p>';
        $titulos = User::getTitles();

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
    public function show(string $id)
    {
        $query = User::FindOrFail($id);

        if ($query->sys01admin) {

            $query->sys01admin = false;

        } else {

            $query->sys01admin = true;

        }

        $query->update();

        return redirect(self::$ruta)->with('mensaje', 'Se modifico el permiso correctamente');
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
