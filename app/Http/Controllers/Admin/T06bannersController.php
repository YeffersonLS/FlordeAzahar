<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\T06banners;
use Illuminate\Http\Request;

class T06bannersController extends Controller
{
    public static $ruta = 'admin/banners';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Banners';
        $sub = '<p>Estas son los Banners que hay de flor de azahar.</p>';
        $titulos = T06banners::getTitles();

        return view('datatable', compact('titulo', 'titulos', 'sub'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = 'Crea una nueva Etiqueta';
        $registro = new T06banners();
        $form_data = ['url' => url('admin/banners'), 'method' => 'POST'];
        return view('admin.banners.create', compact('titulo', 'registro', 'form_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $product = new T06banners();
        $product->fill($data);
        // dd($product);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();

                $path = $image->storeAs('public/images/t06banners', $imageName);

                $product->t06image_path = 'public/storage/' . str_replace('public/', '', $path);
            }
        }

        $product->save();
        // dd($product);
        return redirect(self::$ruta)->with('mensaje', 'Se creo el banner correctamente');
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
        $titulo = 'Edita una nueva Etiqueta';
        $registro = T06banners::FindOrFail($id);
        return view('admin.banners.create', compact('titulo', 'registro'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $product = T06banners::FindOrFail($id);
        $product->fill($data);
        // dd($product);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();

                $path = $image->storeAs('public/images/t06banners', $imageName);

                $product->t06image_path = 'public/storage/' . str_replace('public/', '', $path);
            }
        }

        $product->save();
        // dd($product);
        return redirect(self::$ruta)->with('mensaje', 'Se edito el banner correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        T06banners::find($id)->delete();

        return redirect(self::$ruta)->with('mensaje', 'Se ha eliminado la etiqueta correctamente!');
    }
}
