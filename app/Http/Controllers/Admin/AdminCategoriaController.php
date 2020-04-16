<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categoria;

class AdminCategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $_nombre = $request->get('nombre');
        $categorias = Categoria::where('Nombre', 'like', "%$_nombre%")
                    ->orderBy('Nombre', 'ASC')->paginate(3);
        return view('admin.category.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.crear');
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
            'Nombre' => 'required|max:2|unique:categorias,Nombre',
            'Slug' => 'required|max:50|unique:categorias,Slug'
        ]);
        
        Categoria::create($request->all());
        return redirect()->route('admin.categoria.index')
                ->with('datos', 'Registro creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $cat = Categoria::where('Slug', $slug)->firstOrFail();
        $editar = 'Si';

        return view('admin.category.mostrar', compact('cat', 'editar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $cat = Categoria::where('Slug', $slug)->firstOrFail();
        $editar = 'Si';

        return view('admin.category.editar', compact('cat', 'editar'));
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
        $cat = Categoria::findOrFail($id);

        $request->validate([
            'Nombre' => 'required|max:2|unique:categorias,Nombre,'.$cat->id,
            'Slug' => 'required|max:50|unique:categorias,Slug,'.$cat->id,
        ]);

        /*$cat->Nombre = $request->Nombre;
        $cat->Slug = $request->Slug;
        $cat->Descripcion = $request->Descripcion;
        $cat->save();*/
        $cat->fill($request->all())->save();
        return redirect()->route('admin.categoria.index')
                ->with('datos', 'Registro actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Categoria::findOrFail($id);
        $cat->delete();

        return redirect()->route('admin.categoria.index')
                ->with('datos', 'Registro eliminado correctamente!');
    }
}
