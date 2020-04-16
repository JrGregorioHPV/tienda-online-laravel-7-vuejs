@extends('plantilla.admin')

@section('titulo', 'Ver Categoría')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.categoria.index') }}">Categorías</a></li>
    <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')

<div id="apicategory">
    <form >
    @csrf

    <span style="display: none;" id="editar">{{ $editar }}</span>
    <span style="display: none;" id="nombreTemp">{{ $cat->Nombre }}</span>
    <!-- Default box -->
    <div class="card">
            <div class="card-header">
            <h3 class="card-title">Administración de Categorías</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
            </div>
            <div class="card-body">       
            
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input v-model="nombre"
                        @blur = "getCategoria"
                        @focus = "div_aparecer = false"
                        readonly
                    
                    type="text" class="form-control" name="Nombre" id="nombre" value="{{ $cat->Nombre }}">
                    <label for="slug">Slug</label>
                    <input readonly v-model="generarSlug" type="text" class="form-control" name="Slug" id="slug" value="{{ $cat->Slug }}">
                    
                    <label for="descripcion">Descripción</label>
                    <textarea readonly class="form-control" name="Descripcion" id="descripcion" cols="30" rows="5">{{ $cat->Descripcion }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a class="btn btn-danger" href="{{ route('cancelar', 'admin.categoria.index') }}">Cancelar</a>
                <a class="btn btn-outline-success float-right" href="{{ route('admin.categoria.edit', $cat->Slug) }}">Editar</a>
            </form>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
</div>
@endsection