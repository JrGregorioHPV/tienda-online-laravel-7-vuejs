<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        return Producto::all();
    }

    public function show($slug)
    {
        if(Producto::where('Slug', $slug)->first()){
            return 'Slug existe';
        }
        else {
            return 'Slug disponible';
        }
    }
}
