<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\T02directorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class T02directorioController extends Controller
{
    public static $ruta = 'admin/category';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Categorias';
        $sub = '    <p>Estos son las categorias que hay de flor de azahar.</p>';
        $titulos = T02directorio::getTitles();

        return view('datatable', compact('titulo', 'titulos', 'sub'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = 'Crear una nueva Categoria';
        $registro = new T02directorio();
        return view('admin.category.create', compact('titulo', 'registro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $c = new T02directorio();
        $c->fill($data);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();

                $path = $image->storeAs('public/images/t02directorios', $imageName);

                $c->t02image_path = 'public/storage/' . str_replace('public/', '', $path);
            }
        }
        $c->save();


        return redirect(self::$ruta)->with('mensaje', 'Se creo la categoria correctamente');
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
        $titulo = 'Edita Categoria';
        $registro = T02directorio::findOrFail($id);
        $editMode = true;
        return view('admin.category.create', compact('titulo', 'registro', 'editMode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $c = T02directorio::findOrFail($id);
        $c->fill($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();

                $path = $image->storeAs('public/images/t02directorios', $imageName);

                $c->t02image_path = 'public/storage/' . str_replace('public/', '', $path);
            }
        }
        $c->save();


        return redirect(self::$ruta)->with('mensaje', 'Se edito la Categoria correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = T02directorio::findOrFail($id);
        $blog->delete();
        return redirect(self::$ruta)->with('mensaje', 'Se ha eliminado la categoria correctamente!');
    }
}
