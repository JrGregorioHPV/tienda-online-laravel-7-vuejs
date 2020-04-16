<?php

use Illuminate\Support\Facades\Route;

use App\Producto;
use App\Categoria;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {



/* $prod = new Producto();
$prod->Nombre = 'Producto 4';
$prod->Slug = 'Producto 4';
$prod->Categoria_Id = 4;
$prod->Descripcion_Corta = 'Producto 3';
$prod->Descripcion_Larga = 'Producto 3';
$prod->Especificaciones = 'Producto 3';
$prod->Datos_de_Interes = 'Producto 3';
$prod->Estado = 'Nuevo';
$prod->Activo = 'Si';
$prod->SliderPrincipal = 'No';
$prod->save();
return $prod; */
/*$prod = Producto::find(1)->Categoria;


$cat = Categoria::find(1)->Productos;
return $cat; */

return view('tienda.index');

    //return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function(){
    return view('plantilla.admin');
})->name('admin');

/* Admin -> Categoria */
Route::resource('admin/categoria', 'Admin\AdminCategoriaController')
            ->names('admin.categoria');

/* Admin -> Producto */
Route::resource('admin/producto', 'Admin\AdminProductoController')
->names('admin.producto');

/* Admin -> Cancelar */
Route::get('cancelar/{ruta}', function($ruta){
    return redirect()->route($ruta)
    ->with('cancelar', 'Acción Cancelada!');
})->name('cancelar');

