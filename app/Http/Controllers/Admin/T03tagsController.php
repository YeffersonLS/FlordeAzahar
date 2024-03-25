<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\T03tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class T03tagsController extends Controller
{
    public static $ruta = 'admin/tags';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Etiquetas';
        $sub = '<p>Estas son las etiquetas que hay de flor de azahar.</p>';
        $titulos = T03tag::getTitles();

        return view('datatable', compact('titulo', 'titulos', 'sub'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = 'Crea una nueva Etiqueta';
        $registro = new T03tag();
        $form_data = ['url' => url('admin/tags'), 'method' => 'POST'];
        return view('admin.tags.create', compact('titulo', 'registro', 'form_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            't03slug' => 'required|unique:t03tag'
        ]);
        $data = $request->all();
        // dd($data);
        $c = new T03tag();
        $c->fill($data);
        $c->t03usuario = Auth::user()->sys01id;
        // dd($data,$c);
        $c->save();

        return redirect(self::$ruta)->with('mensaje', 'Se creo la etiqueta correctamente');
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
        $titulo = 'Edita la Etiqueta';
        $editMode = true;
        $registro = T03tag::find($id);
        if (!$registro) {
            abort(404);
        }
        return view('admin.tags.create', compact('titulo', 'registro', 'editMode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $q = T03tag::find($id);
        $q->fill($data);
        // dd($t01blog);
        $q->update();

        return redirect(self::$ruta)->with('mensaje', 'Se ha editado el post correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        T03tag::find($id)->delete();

        return redirect(self::$ruta)->with('mensaje', 'Se ha eliminado la etiqueta correctamente!');
    }
}
