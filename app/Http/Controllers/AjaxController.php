<?php

namespace App\Http\Controllers;

use App\Models\T04productos;
use App\Models\T10combos;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function eliminarFotoProducto($productoId, $imagenId)
    {
        $producto = T04productos::findOrFail($productoId);

        // Obtener la imagen relacionada con el ID proporcionado
        $imagen = $producto->images()->findOrFail($imagenId);

        // Eliminar la imagen
        $imagen->delete();

        // Si necesitas devolver alguna respuesta, puedes hacerlo aquí
        return response()->json(['success' => true]);
    }

    public function agregarProducto(Request $request)
    {
        $id = $request->get('id');
        $p = T04productos::FindOrFail($id);

        $producto = [
            't04id' => $p->t04id,
            't04nombre' => $p->t04nombre,
            't04precio' => $p->t04precio,
            't04sabor' => $p->t04sabor,
            't04cantidad' => $p->t04cantidad,
            't04presentacion' => $p->t04presentacion
        ];
        return json_encode($producto, true);
    }

    public function eliminarFotoCombo($productoId, $imagenId)
    {
        $combo = T10combos::findOrFail($productoId);

        // Obtener la imagen relacionada con el ID proporcionado
        $imagen = $combo->images()->findOrFail($imagenId);

        // Eliminar la imagen
        $imagen->delete();

        // Si necesitas devolver alguna respuesta, puedes hacerlo aquí
        return response()->json(['success' => true]);
    }
}
