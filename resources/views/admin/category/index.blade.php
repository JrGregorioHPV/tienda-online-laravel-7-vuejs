@extends('plantilla.admin')

@section('titulo', 'Administración de Categorías')

@section('breadcrumb')
    <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')

<div id="confirmarEliminar" class="row">
    <span style="display: none;" id="URLbase">{{ route('admin.categoria.index') }}</span>
    @include('custom.modal_eliminar')
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sección de Categorías</h3>

                <div class="card-tools">
                    <form action="">

                    
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="nombre" class="form-control float-right" placeholder="Buscar"
                     value="{{ request()->get('nombre') }}">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <a class="btn btn-primary m-2 float-right" href="{{ route('admin.categoria.create') }}">Crear Categoría</a>
                <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Slug</th>
                      <th>Descripción</th>
                      <th>Fecha Creación</th>
                      <th>Fecha Modificacion</th>
                      <th colspan="3"></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($categorias as $categoria)
                    <tr>
                      <td>{{ $categoria->id }}</td>
                      <td>{{ $categoria->Nombre }}</td>
                      <td>{{ $categoria->Slug }}</td>
                      <td>{{ $categoria->Descripcion }}</td>
                      <td>{{ $categoria->created_at }}</td>
                      <td>{{ $categoria->updated_at }}</td>
                      <td><a class="btn btn-default" href="{{ route('admin.categoria.show', $categoria->Slug) }}">Ver</a></td>
                      <td><a class="btn btn-info" href="{{ route('admin.categoria.edit', $categoria->Slug) }}">Editar</a></td>
                      <td><a class="btn btn-danger" href="{{ route('admin.categoria.index') }}"
                        v-on:click.prevent="deseas_eliminar({{ $categoria->id }})">Eliminar</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                {{ $categorias->appends($_GET)->links() }}
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
@endsection