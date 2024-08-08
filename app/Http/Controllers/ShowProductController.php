<?php

namespace App\Http\Controllers;

use App\Models\T04productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Catálogo de Productos';
        $products = T04productos::select('t04id', 't04slug', 't04nombre', 't04categoria', 't04precio', 'i.image_path', 'c.t02nombre')
            ->leftJoin('t02directorios as c', 'c.t02id', '=', 't04categoria')
            ->Join('r03products_images as i', function($join) {
                $join->on('i.r03product', '=', 't04id')
                    ->whereRaw('i.r03id = (select r03id from r03products_images where r03product = t04id limit 1)');
            })
            ->get();

        // dd($products);
        return view('products.home',compact('products', 'titulo'));
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
    public function show($t04slug)
    {
        // dd($t04slug);
        $product = T04productos::where('t04slug', '=', $t04slug)->firstOrFail();
        // dd($product);
        $image = DB::table('r03products_images')
        ->select('image_path')->where ('r03product', '=', $product->t04id)
        ->first();
        $images = DB::table('r03products_images')
        ->select('image_path')->where ('r03product', '=', $product->t04id)
        ->get();
        $products = T04productos::select('t04id', 't04nombre', 't04categoria', 't04slug', 't04precio', 'i.image_path', 'c.t02nombre')
            ->where('t04categoria', '=', $product->t04categoria)
            ->leftJoin('t02directorios as c', 'c.t02id', '=', 't04categoria')
            ->Join('r03products_images as i', function($join) {
                $join->on('i.r03product', '=', 't04id')
                    ->whereRaw('i.r03id = (select r03id from r03products_images where r03product = t04id limit 1)');
            })
            ->get();

        return view('products.product', compact('products', 'product','images', 'image'));
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
