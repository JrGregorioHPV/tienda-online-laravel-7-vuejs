<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;

class AdminProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $_nombre = $request->get('nombre');
        $productos = Producto::with('images', 'categoria')
                    ->where('Nombre', 'like', "%$_nombre%")
                    ->orderBy('Nombre', 'ASC')->paginate(4);
        return view('admin.product.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::orderBy('Nombre', 'ASC')->get();
        return view('admin.product.crear', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|unique:productos,Nombre',
            'Slug' => 'required|unique:productos,Slug',
            'Imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $URLImagenes = [];
        /* Si tiene en el campo imagen un archivo */
        if($request->hasFile('Imagenes')){
            $imagenes = $request->file('Imagenes');
        }

        // Recorrer imagenes
        foreach($imagenes as $imagen){
            $nombre = time().'_'.$imagen->getClientOriginalName(); /* obtener nombre de la imagen */
            $ruta = public_path().'/imagenes'; /* Guarda la imagen  ruta completa */
            $imagen->move($ruta, $nombre);
            $URLImagenes[]['URL'] = '/imagenes/'.$nombre;
        }
        //return $URLImagenes;
        
        $prod = new Producto;
        /* Campos SQL               = Nombre de Campos HTML */
        $prod->Nombre               = $request->Nombre;
        $prod->Slug                 = $request->Slug;
        $prod->Categoria_Id         = $request->CategoriaId;
        $prod->Cantidad             = $request->Cantidad;
        $prod->Precio_Anterior      = $request->PrecioAnterior;
        $prod->Precio_Actual        = $request->PrecioActual;
        $prod->Porcentaje_Descuento = $request->PorcentajedeDescuento;
        $prod->Descripcion_Corta    = $request->Descripcion_Corta;
        $prod->Descripcion_Larga    = $request->Descripcion_Larga;
        $prod->Especificaciones     = $request->Especificaciones;
        $prod->Datos_de_Interes     = $request->Datos_de_Interes;
        $prod->Estado               = $request->Estado;

        if($request->Activo){
            $prod->Activo = 'Si';
        } else {
            $prod->Activo = 'No';
        }

        if($request->SliderPrincipal){
            $prod->SliderPrincipal = 'Si';
        } else {
            $prod->SliderPrincipal = 'No';
        }

        $prod->save();

        $prod->images()->createMany($URLImagenes);
        //return $prod->images;

        return redirect()->route('admin.producto.index')
                ->with('datos', 'Registro creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $producto = Producto::with('images', 'categoria')
            ->where('Slug', $slug)->firstOrFail();

        $categorias = Categoria::orderBy('Nombre', 'ASC')->get();
        return view('admin.product.editar', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
