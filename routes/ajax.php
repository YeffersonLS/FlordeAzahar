<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('eliminar-imagen/{productoId}/{imagenId}', [\App\Http\Controllers\AjaxController::class, 'eliminarFotoProducto'])->name('eliminar.imagen');

Route::get('eliminar-combo/{productoId}/{imagenId}', [\App\Http\Controllers\AjaxController::class, 'eliminarFotoCombo'])->name('eliminar.imagen.combo');

Route::get('agregar-producto', [\App\Http\Controllers\AjaxController::class, 'agregarProducto'])->name('agregar.producto');




