<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FuncionesFront;
use App\Models\T10combos;
use App\Models\T11combosagendados;
use Carbon\Carbon;
use Illuminate\Http\Request;

class T11combosAgendadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = T10combos::where('t10vencimiento', '>=', Carbon::now()->format("Y-m-d") )
        ->get()
        ;

        $titulo = 'Calendario de Eventos';
        $events = [];
        foreach ($registros as $registro) {
            $events[] = [
                'title' => $registro->t10nombre,
                'start'=> $registro->t10vencimiento,
                'url' => url('admin/diary/'.$registro->t10id),
            ];
        }

        // dd($events);
        return view('admin.combos.calendary', compact('titulo', 'events'));
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
        $titulo = "Edita la entrega del combo";
        $registro = T11combosagendados::FindOrFail($id);
        $horas = FuncionesFront::horaEntregaCombos();

        return view('admin.combos.edit', compact('registro', 'titulo', 'horas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $registro = T11combosagendados::FindOrFail($id);
        $registro->fill($data);
        $registro->update();

        return redirect(url('admin/diary', $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function dayCombo($id){

        $registros = T11combosagendados::select('t11combo', 't11nombre', 't11pago', 't11hora', 'c.t10vencimiento', 'c.t10nombre')
        ->leftJoin('t10combos as c', 't10id', '=', 't11combo')
        ->where('t11combo', '=', $id)
        ->get();

        // dd($registros);
        // dd($nombre);

        $events = [];
        foreach ($registros as $registro) {
            $events[] = [
                'title' => $registro->t11nombre,
                'start'=> $registro->t10vencimiento.' '.$registro->t11hora,
                'color' => $registro->t11pago ?  : 'red', // Color rojo si t11pago es true
                'url' => url('admin/diary/'.$registro->t11combo.'/edit'),
            ];
            $titulo = $registro->t10nombre;
            $fecha = $registro->t10vencimiento;
        }

        return view('admin.combos.calendaryDay', compact('titulo', 'events', 'fecha'));

    }
}
