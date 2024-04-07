<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImagesProductRequest;
use App\Models\T02directorio;
use App\Models\T03tag;
use App\Models\T04productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class T04productosController extends Controller
{
    public static $ruta = 'admin/products';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Productos';
        $sub = '<p>Estas son los Productos que hay de flor de azahar.</p>';
        $titulos = T04productos::getTitles();
        return view('datatable', compact('titulo', 'titulos', 'sub'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = 'Crea un nuevo Producto';
        $registro = new T04productos();
        $categoria = T02directorio::where('t02grupo', '=', 'PRODUCTO')->pluck('t02nombre', 't02id');
        $tags = T03tag::where('t03tipo', '=', 'PRODUCTOS')->pluck('t03nombre', 't03id');
        $form_data = ['url' => url('admin/products'), 'method' => 'POST'];
        $sabores = T02directorio::where('t02grupo', '=', 'SABORES')->pluck('t02nombre', 't02id');

        return view('admin.products.create', compact('titulo', 'registro', 'form_data', 'categoria', 'tags', 'sabores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $c = new T04productos();
        $c->fill($data);
        $c->t04usuario = Auth::user()->sys01id;
        // dd($c);
        $t04saborString = implode(',', $request->t04sabores);
        $c->t04sabores = $t04saborString;
        $c->save();

        if($request->t04tags){
            $c->tags()->attach($request->t04tags);
        }


        return redirect(self::$ruta)->with('mensaje', 'Se creo el post correctamente');
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
        $titulo = 'Edita el Producto';
        $editMode = true;
        $registro = T04productos::find($id);
        if (!$registro) {
            abort(404);
        }
        $categoria = T02directorio::where('t02grupo', '=', 'PRODUCTO')->pluck('t02nombre', 't02id');
        $tags = T03tag::where('t03tipo', '=', 'PRODUCTOS')->pluck('t03nombre', 't03id');
        $selectedTags = $registro->tags->pluck('t03id')->toArray();
        $sabores = T02directorio::where('t02grupo', '=', 'SABORES')->pluck('t02nombre', 't02id');
        $selectSabores = explode(',', $registro->t04sabores);

        return view('admin.products.create', compact('titulo', 'registro', 'categoria', 'editMode', 'tags', 'selectedTags', 'sabores', 'selectSabores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        // dd($data);
        $t04saborString = implode(',', $request->t04sabores);
        // dd($t04saborString);
        $q = T04productos::find($id);
        $q->fill($data);
        $q->t04sabores = $t04saborString;
        // dd($q);
        if($request->t04tags){
            $q->tags()->detach();
            $q->tags()->attach($request->t04tags);
        }


        $q->update();

        return redirect(self::$ruta)->with('mensaje', 'Se ha editado el producto correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = T04productos::findOrFail($id);

        // Eliminar registros de la tabla intermedia (pivot)
        $blog->tags()->detach();

        $blog->delete();

        return redirect(self::$ruta)->with('mensaje', 'Se ha eliminado el blog correctamente!');
    }

    public function indexRecetario()
    {
        $titulo = 'Post de los Productos';
        $sub = '<p>Estas son los Post de los Productos que hay de flor de azahar.</p>';
        $titulos = T04productos::getTitles();
        return view('datatable', compact('titulo', 'titulos', 'sub'));
    }

    public function recetas(string $id)
    {
        $titulo = 'Crea la Receta del Producto';
        $registro = T04productos::findOrFail($id);
        // dd($registro);
        return view('admin.products.createPost', compact('titulo', 'registro'));
    }

    public function recetasPost(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $c = T04productos::findOrFail($request->t04id);
        $c->fill($data);
        $c->t04usuario = Auth::user()->sys01id;
        // dd($c);
        $c->update();

        return redirect(self::$ruta.'/recetas')->with('mensaje', 'Se creo el post correctamente');
    }

    public function indexImages()
    {
        $titulo = 'Imagenes Productos';
        $sub = '<p>Estas son los Productos que hay de flor de azahar y sus imagenes.</p>';
        $titulos = T04productos::getTitlesImages();
        return view('datatable', compact('titulo', 'titulos', 'sub'));
    }

    public function images(string $id)
    {
        $titulo = 'Sube o edita la imagen del producto';
        $registro = T04productos::findOrFail($id);
        // dd($registro);
        $imagenes_relacionadas = $registro->images;
        // dd($imagenes_relacionadas);
        return view('admin.products.image', compact('titulo', 'registro', 'imagenes_relacionadas'));
    }

    public function imagesPost(ImagesProductRequest $request)
    {
        $data = $request->all();
        $product = T04productos::findOrFail($request->t04id);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName(); // Generar un nombre único para la imagen

                // Mover la imagen a la carpeta de almacenamiento
                $image->storeAs('public/images/t04productos', $imageName);

                // Guardar la ruta de la imagen en la base de datos
                $product->images()->create([
                    'image_path' => 'public/storage/images/t04productos/' . $imageName // Guardar la ruta de la imagen en la base de datos
                ]);
            }
        }


        return redirect(self::$ruta.'/images')->with('mensaje', 'Se anexaron las imagenes correctamente');
    }

}
