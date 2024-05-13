<?php

namespace App\Http\Controllers;

use App\Models\T10combos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowCombosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $combos = T10combos::where('t10vencimiento', '>=', Carbon::now()->format("Y-m-d") )
        ->get()
        ;

        // dd($combos);
         return view('combos.home', compact('combos'));
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

        $combo = T10combos::FindOrFail($id);

        // if ($combo->t10vencimiento >= Carbon::now()->format("Y-m-d")) {
        //     return view('home');
        // }

        $productos = $combo->products;

        $image = DB::table('r05combo_images')
        ->select('image_path')->where ('r05combo', '=', $combo->t10id)
        ->first();

        $images = DB::table('r05combo_images')
        ->select('image_path')->where ('r05combo', '=', $combo->t10id)
        ->get();


        // dd($combo);

        return view('combos.combo',compact('combo', 'productos', 'image', 'images'));
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
