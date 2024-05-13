<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionesFront extends Controller
{
    public static function horaEntregaCombos() {

        $horas = [];

        for ($i = 9; $i < 18; $i++) {
            $horaFormateada = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
            $horas[] = $horaFormateada;
        }

        return $horas;
    }
}
