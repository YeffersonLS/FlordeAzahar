<?php

namespace App\Http\Controllers;

use App\Models\T02directorio;
use App\Models\T04productos;
use Illuminate\Http\Request;

class ShowCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = T02directorio::where('t02grupo', '=', 'PRODUCTO')
        ->WhereNotNull('t02image_path')
        ->get();
        return view('category.home',compact('categorys'));
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
        $category = T02directorio::FindOrFail($id);
        $products = T04productos::select('t04id', 't04slug', 't04nombre', 't04categoria', 't04precio', 'i.image_path', 'c.t02nombre')
            ->where('t04categoria', '=', $category->t02id)
            ->leftJoin('t02directorios as c', 'c.t02id', '=', 't04categoria')
            ->Join('r03products_images as i', function($join) {
                $join->on('i.r03product', '=', 't04id')
                    ->whereRaw('i.r03id = (select r03id from r03products_images where r03product = t04id limit 1)');
            })
            ->get();


        return view('category.products', compact('products', 'category'));
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
