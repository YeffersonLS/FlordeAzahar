<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\T04productos;
use App\Models\T10combos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class T10combosController extends Controller
{
    public static $ruta = 'admin/combos';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Combos';
        $sub = '    <p>Estos son los combos que hay de flor de azahar.</p>';
        $titulos = T10combos::getTitles();

        return view('datatable', compact('titulo', 'titulos', 'sub'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = 'Crea una nueva Etiqueta';
        $registro = new T10combos();
        $productos = T04productos::all()->pluck('t04id', 't04nombre');

        // dd($productos);

        return view('admin.combos.create', compact('titulo', 'registro', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $c = new T10combos();
        $c->fill($data);
        $c->t10usuario = Auth::user()->sys01id;
        // dd($c);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/t10combos'), $imageName);
                $c->t01image_path = 'images/t10combos/' . $imageName;
            }
        }

        $c->save();

        if($request->productos){
            $c->products()->attach($request->productos);
        }


        return redirect(self::$ruta)->with('mensaje', 'Se creo el combo correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $registro = T10combos::find($id);
        $titulo = 'Crea una nueva Etiqueta';
        $productos = T04productos::all()->pluck('t04id', 't04nombre');
        $editMode = true;
        if (!$registro) {
            abort(404);
        }
        $productos_relacionados = $registro->products->pluck('t04nombre', 't04id')->toArray();
        // dd($productos_relacionados);
        return view('admin.combos.create', compact('titulo', 'registro', 'productos', 'editMode', 'productos_relacionados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        // dd($data);
        $q = T10combos::find($id);
        $q->fill($data);
        if($request->productos){
            $q->products()->detach();
            $q->products()->attach($request->productos);
        }


        $q->update();

        return redirect(self::$ruta)->with('mensaje', 'Se ha editado el combo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $q = T10combos::findOrFail($id);

        // Eliminar registros de la tabla intermedia (pivot)
        $q->products()->detach();

        $q->delete();

        return redirect(self::$ruta)->with('mensaje', 'Se ha eliminado el combo correctamente!');
    }
}
