@extends('plantilla.admin')

@section('titulo', 'Editar Categoría')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.categoria.index') }}">Categorías</a></li>
    <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')

<div id="apicategory">
    <form action="{{ route('admin.categoria.update', $cat->id) }}" method="POST">
    @csrf
    @method('PUT')
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
                    
                    type="text" class="form-control" name="Nombre" id="nombre" value="{{ $cat->Nombre }}">
                    <label for="slug">Slug</label>
                    <input readonly v-model="generarSlug" type="text" class="form-control" name="Slug" id="slug" value="{{ $cat->Slug }}">
                    <div v-if="div_aparecer" v-bind:class="div_claseSlug">
                        @{{ div_mensajeSlug }}
                    </div>
                    <br v-if="div_aparecer">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" name="Descripcion" id="descripcion" cols="30" rows="5">{{ $cat->Descripcion }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a class="btn btn-danger" href="{{ route('cancelar', 'admin.categoria.index') }}">Cancelar</a>
            <input 
                :disabled = "deshabilitar_btn == 1"
                type="submit" value="Guardar" class="btn btn-primary float-right">
            </form>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
</div>
@endsection