<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionesFront extends Controller
{
    public function horaEntregaCombos (){

        $horas = [];

        for ($i=9; $i < 18; $i++) {
            $horas += $i;
        }

        return $horas;
    }
}
