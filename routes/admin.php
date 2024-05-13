<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Ui\AuthRouteMethods;


Route::middleware('admin')->group(function () {


Route::get('', [AdminController::class,'index'])->name('admin.home');
Route::resource('blogs', \App\Http\Controllers\Admin\T01blogsController::class)->names('admin.blogs');
// Route::get('admin/blogs/{blog}/edit', [\App\Http\Controllers\Admin\T01blogsController::class, 'edit'])->name('admin.blogs.edit');
// Route::put('admin/blogs/{blog}', [\App\Http\Controllers\Admin\T01blogsController::class, 'update'])->name('admin.blogs.update');
// Route::delete('admin/blogs/{blog}', [\App\Http\Controllers\Admin\T01blogsController::class, 'destroy'])->name('admin.blogs.destroy');
Route::get('json.admin/blogs', function (Request $request) {
    return \App\Models\T01blog::getDatatable($request);
})->name('json.admin/blogs');

Route::resource('tags', \App\Http\Controllers\Admin\T03tagsController::class)->names('admin.tags');
Route::get('json.admin/tags', function (Request $request) {
    return \App\Models\T03tag::getDatatable($request);
})->name('json.admin/tags');

Route::get('products/recetas', [\App\Http\Controllers\Admin\T04productosController::class, 'indexRecetario'])->name('admin.products.recetas');
Route::get('products/recetas/{blog}/crear', [\App\Http\Controllers\Admin\T04productosController::class, 'recetas'])->name('admin.products.recetasCrear');
Route::post('admin/products/recetas', [\App\Http\Controllers\Admin\T04productosController::class, 'recetasPost'])->name('admin.products.recetasPost');
Route::get('json.admin/products/recetas', function (Request $request) {
    return \App\Models\T04productos::getDatatableRecetas($request);
})->name('json.admin/products/recetas');

Route::get('products/images', [\App\Http\Controllers\Admin\T04productosController::class, 'indexImages'])->name('admin.products.images');
Route::get('products/images/{blog}/crear', [\App\Http\Controllers\Admin\T04productosController::class, 'images'])->name('admin.products.imagesCrear');
Route::post('admin/products/images', [\App\Http\Controllers\Admin\T04productosController::class, 'imagesPost'])->name('admin.products.imagesPost');
Route::get('json.admin/products/images', function (Request $request) {
    return \App\Models\T04productos::getDatatableImages($request);
})->name('json.admin/products/images');


Route::resource('products', \App\Http\Controllers\Admin\T04productosController::class)->names('admin.products');
Route::get('json.admin/products', function (Request $request) {
    return \App\Models\T04productos::getDatatable($request);
})->name('json.admin/products');


Route::resource('products/post', \App\Http\Controllers\Admin\t05postProductosController::class)->names('admin.products.post');
Route::get('json.admin/products/post', function (Request $request) {
    return \App\Models\T05postProductos::getDatatable($request);
})->name('json.admin/products/post');

Route::resource('banners', \App\Http\Controllers\Admin\T06bannersController::class)->names('admin.banners');
Route::get('json.admin/banners', function (Request $request) {
    return \App\Models\T06banners::getDatatable($request);
})->name('json.admin/banners');


Route::resource('category', \App\Http\Controllers\Admin\T02directorioController::class)->names('admin.category');
Route::get('json.admin/category', function (Request $request) {
    return \App\Models\T02directorio::getDatatable($request);
})->name('json.admin/category');


Route::resource('user', \App\Http\Controllers\Admin\Sys01usuariosController::class)->names('admin.user');
Route::get('json.admin/user', function (Request $request) {
    return \App\Models\User::getDatatable($request);
})->name('json.admin/user');

Route::resource('sales', \App\Http\Controllers\Admin\T09ventasController::class)->names('admin.sales');
Route::get('json.admin/sales', function (Request $request) {
    return \App\Models\T09venta::getDatatable($request);
})->name('json.admin/sales');

Route::get('combos/images', [\App\Http\Controllers\Admin\T10combosController::class, 'indexImages'])->name('admin.combos.images');
Route::get('combos/images/{blog}/crear', [\App\Http\Controllers\Admin\T10combosController::class, 'images'])->name('admin.combos.imagesCrear');
Route::post('admin/combos/images', [\App\Http\Controllers\Admin\T10combosController::class, 'imagesPost'])->name('admin.combos.imagesPost');
Route::resource('combos', \App\Http\Controllers\Admin\T10combosController::class)->names('admin.combos');
Route::get('json.admin/combos', function (Request $request) {
    return \App\Models\T10combos::getDatatable($request);
})->name('json.admin/combos');

Route::get('diary/{id}', [\App\Http\Controllers\Admin\T11combosAgendadosController::class, 'dayCombo'])->name('admin.diary.dayCombo');
Route::resource('diary', \App\Http\Controllers\Admin\T11combosAgendadosController::class)->names('admin.diary');
Route::get('json.admin/diary', function (Request $request) {
    return \App\Models\T11combosagendados::getDatatable($request);
})->name('json.admin/diary');
});

