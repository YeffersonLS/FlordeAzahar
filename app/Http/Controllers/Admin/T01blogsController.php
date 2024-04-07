<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Models\T01blog;
use App\Models\T02directorio;
use App\Models\T03tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class T01blogsController extends Controller
{
    public static $ruta = 'admin/blogs';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Blogs POST';
        $sub = '    <p>Estos son los blogs que hay de flor de azahar.</p>';
        $titulos = T01blog::getTitles();

        return view('datatable', compact('titulo', 'titulos', 'sub'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = 'Crear nuevo Blog';
        $registro = new T01blog();
        $categoria = T02directorio::where('t02grupo', '=', 'BLOG')->pluck('t02nombre', 't02id');
        $tags = T03tag::where('t03tipo', '=', 'BLOGS')->pluck('t03nombre', 't03id');
        return view('admin.blogs.create', compact('titulo', 'registro', 'categoria', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->all();

        $c = new T01blog();
        $c->fill($data);
        $c->t01usuario = Auth::user()->sys01id;
        // dd($data,$c);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();

                $path = $image->storeAs('public/images/t01blogs', $imageName);

                $c->t01image_path = 'public/storage/' . str_replace('public/', '', $path);
            }
        }
        $c->save();

        if($request->t01tags){
            $c->tags()->attach($request->t01tags);
        }

        return redirect(self::$ruta)->with('mensaje', 'Se creo el post correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $titulo = 'Edita el Blog';
        $editMode = true;
        $registro = T01blog::find($id);
        if (!$registro) {
            abort(404);
        }
        $categoria = T02directorio::where('t02grupo', '=', 'BLOG')->pluck('t02nombre', 't02id');
        $tags = T03tag::where('t03tipo', '=', 'BLOGS')->pluck('t03nombre', 't03id');

        return view('admin.blogs.create', compact('titulo', 'registro', 'categoria', 'editMode', 'tags'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $q = T01blog::findOrFail($id);
        $q->fill($data);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();

                $path = $image->storeAs('public/images/t01blogs', $imageName);

                $q->t01image_path = 'public/storage/' . str_replace('public/', '', $path);
            }
        }

        $q->update();

        return redirect(self::$ruta)->with('mensaje', 'Se ha editado el post correctamente');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = T01blog::findOrFail($id);

        // Eliminar registros de la tabla intermedia (pivot)
        $blog->tags()->detach();

        $blog->delete();

        return redirect(self::$ruta)->with('mensaje', 'Se ha eliminado el blog correctamente!');
    }
}
