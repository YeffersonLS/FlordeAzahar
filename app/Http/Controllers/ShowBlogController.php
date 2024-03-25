<?php

namespace App\Http\Controllers;

use App\Models\T01blog;
use Illuminate\Http\Request;

class ShowBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = T01blog::select('t01id', 't01nombre', 'u.sys01fullname','t01views', 'd.t02nombre', 't01categoria', 't01usuario', 't01image_path', 't01descripcion')
        ->leftJoin('sys01usuarios as u', 'u.sys01id', '=', 't01usuario')
        ->leftJoin('t02directorios as d', 'd.t02id', '=', 't01categoria')
        ->orderBy('t01id', 'desc')
        ->get()
        ;

        // dd($blogs);
        return view('blog.home',compact('blogs'));


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
        $blog = T01blog::FindOrFail($id);

        return view('blog.show',compact('blog'));
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
