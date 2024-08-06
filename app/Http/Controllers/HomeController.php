<?php

namespace App\Http\Controllers;

use App\Models\T02directorio;
use App\Models\T03tag;
use App\Models\T04productos;
use App\Models\T06banners;
use App\Models\T10combos;
use App\Models\T11combosagendados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = T04productos::select('t04id', 't04slug', 't04nombre', 't04categoria', 't04precio', 'i.image_path', 'c.t02nombre')
            ->leftJoin('t02directorios as c', 'c.t02id', '=', 't04categoria')
            ->Join('r03products_images as i', function($join) {
                $join->on('i.r03product', '=', 't04id')
                    ->whereRaw('i.r03id = (select r03id from r03products_images where r03product = t04id limit 1)');
            })
            ->orderBy('t04categoria')
            ->get();
        $banners = T06banners::where('t06publicado', '=', true)
        ->get();
        $categorys = T02directorio::where('t02grupo', '=', 'PRODUCTO')
        ->WhereNotNull('t02image_path')
        ->get();

        if(Auth::check()){
            if(Auth::user()->sys01id == 1){
                dd($products);
            }
        }

        // match(true){
        //     $banners < 8 => 'No hay banners'
        // };

        // dd($banners);

        return view('home',compact('products', 'banners', 'categorys'));
    }

    public function test()
    {
        // dd(env('APP_ENV'));
        // if (env('APP_ENV') === "local") {
        //     dd('local');
        //    } else {
        //     dd('production');
        // }
        // exit;
        // $var =  ['Noticias', 'Opinion', 'Entretenimiento', 'Salud', 'Estilo de Vida', 'Tecnologia', 'Deportes', 'Educacion', 'Finanzas', 'Cultura'];

        // foreach($var as $v){
        //     $c = new T02directorio();
        //     $nueva_data = [
        //         't02nombre' => $v,
        //         't02grupo' => 'BLOG'
        //     ];
        //     $c -> fill($nueva_data);
        //     // dd($c);php a
        //     $c->save();
        // }

        // $var = ['Dieta', 'Helados', 'Salud', 'rutina', 'Cocina', 'Tiempo libre', 'Saludable'];

        // foreach($var as $v){
        //     $c = new T03tag();
        //     $nueva_data = [
        //         't03nombre' => $v,
        //         't03tipo' => 'BLOGS',
        //         't03slug' => strtolower($v),
        //         't03usuario' => Auth::user()->sys01id,
        //     ];
        //     $c -> fill($nueva_data);
        //     // dd($c);php a
        //     $c->save();
        // }


        // $var =  ['Bebidas', 'Helados', 'Postres', 'Alimentos'];

        // foreach($var as $v){
        //     $c = new T02directorio();
        //     $nueva_data = [
        //         't02nombre' => $v,
        //         't02grupo' => 'PRODUCTO'
        //     ];
        //     $c -> fill($nueva_data);
        //     // dd($c);
        //     $c->save();
        // }

        // $var = ['Chocolate', 'Vainilla', 'Fresa', 'ICE', 'Soda Italiana', 'Frappe', 'Flan','Gelatina Mosaico', 'Cafe', 'Moka', 'Decarado'];

        // foreach($var as $v){
        //     $c = new T03tag();
        //     $nueva_data = [
        //         't03nombre' => $v,
        //         't03tipo' => 'PRODUCTOS',
        //         't03slug' => strtolower($v),
        //         't03usuario' => Auth::user()->sys01id,
        //     ];
        //     $c -> fill($nueva_data);
        //     // dd($c);php a
        //     $c->save();
        // }



        // $var = ['Efectivo', 'Tarjeta Credito', 'Tarjeta Debito', 'Consignacion'];

        // foreach($var as $v){
        //     $c = new T02directorio();
        //     $nueva_data = [
        //         't02nombre' => $v,
        //         't02grupo' => 'formas_pago',
        //     ];
        //     $c -> fill($nueva_data);
        //     // dd($c);php a
        //     $c->save();
        // }

        // $var =  ['Vainilla', 'Fresa', 'Chocolate', 'Taro', 'Cereza', 'Mora Azul', 'Mango', 'Limon', 'Oreo', 'Cappucino', 'Moka', 'Yogurt Griego', 'Yogurt Griego Carbon Activado'];

        // foreach($var as $v){
        //     $c = new T02directorio();
        //     $nueva_data = [
        //         't02nombre' => $v,
        //         't02grupo' => 'SABORES'
        //     ];
        //     $c -> fill($nueva_data);
        //     $c->save();
        // }

        redirect('/');
    }

    public function tienda()
    {
        return view('tienda');
    }

    public function contacto()
    {
        return view('contacto');
    }

    public function contactoPost(Request $request)
    {
        $data = $request->all();

        dd($data);
    }

    public function nosotros()
    {
        return view('nosotros');
    }

    public function search(Request $request)
    {
        $titulo = 'Resultado de la busqueda';
        $query = $request->input('query');
        $query = strtoupper($query); // Convertir la consulta a mayúsculas
        $products = T04productos::select('t04id', 't04slug', 't04nombre', 't04categoria', 't04precio', 'i.image_path', 'c.t02nombre')
            ->whereRaw('UPPER(t04nombre) like ?', ['%'.$query.'%'])
            ->leftJoin('t02directorios as c', 'c.t02id', '=', 't04categoria')
            ->Join('r03products_images as i', function($join) {
                $join->on('i.r03product', '=', 't04id')
                    ->whereRaw('i.r03id = (select r03id from r03products_images where r03product = t04id limit 1)');
            })
            ->get();

        return view('products.home',compact('products', 'titulo'));
    }

    public function agendar($id)
    {
        if (!auth()->check()) {
            return view('auth.register');
        } else {
            $user = Auth::user();
            $combo = T10combos::findOrFail($id);

            $horas = FuncionesFront::horaEntregaCombos();

            // dd(FuncionesFront::horaEntregaCombos());

            return view('combos.agendar', compact('user', 'combo', 'horas'));
        }

    }

    public function agendarPost(Request $request) {
        $data = $request->all();
        $registro = new T11combosagendados();
        $registro->fill($data);
        $registro->t11cliente = Auth::user()->sys01id;
        // dd($registro);
        $registro->save();

        return redirect('/combos')->with('mensaje', 'Se agendo el combo Correctamente');

    }

    public function combosAgendados() {

        $query = T11combosagendados::select('t11cliente', 't11hora', 't11combo', 'c.t10nombre')
        ->leftJoin('t10combos as c', 't10id', '=', 't11combo')
        ->get();

        // dd($query);

        return view('combos', compact ('query'));


    }
}
