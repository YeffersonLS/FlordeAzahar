<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImagesProductRequest;
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
        $c = new T10combos();
        $c->fill($data);
        $c->t10usuario = Auth::user()->sys01id;
        // dd($c);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();

                $path = $image->storeAs('public/images/t10combo', $imageName);

                $c->t10image  = 'public/storage/' . str_replace('public/', '', $path);
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

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();

                $path = $image->storeAs('public/images/t10combo', $imageName);

                $q->t10image  = 'public/storage/' . str_replace('public/', '', $path);
            }
        }
        // dd($request->hasFile('image'));
        // dd($q);

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

    public function images(string $id)
    {
        $titulo = 'Sube o edita del combo';
        $registro = T10combos::findOrFail($id);
        // dd($registro);
        $imagenes_relacionadas = $registro->images;
        // dd($imagenes_relacionadas);
        return view('admin.combos.image', compact('titulo', 'registro', 'imagenes_relacionadas'));
    }

    public function imagesPost(ImagesProductRequest $request)
    {

        $data = $request->all();
        $product = T10combos::findOrFail($request->t10id);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName(); // Generar un nombre único para la imagen

                // Mover la imagen a la carpeta de almacenamiento
                $image->storeAs('public/images/t10combo/ruletaFotos', $imageName);

                // Guardar la ruta de la imagen en la base de datos
                $product->images()->create([
                    'image_path' => 'public/storage/images/t10combo/ruletaFotos' . $imageName // Guardar la ruta de la imagen en la base de datos
                ]);
            }
        }

        return redirect(self::$ruta)->with('mensaje', 'Se anexaron las imagenes correctamente');
    }
}
