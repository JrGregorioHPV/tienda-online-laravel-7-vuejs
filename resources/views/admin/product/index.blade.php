@extends('plantilla.admin')

@section('titulo', 'Administración de Productos')

@section('breadcrumb')
    <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')

<style>
  .tabla-1 {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    text-align: center;
  }

  .tabla-1 td, .tabla-1 th {
    padding: .75rem;
    vertical-align: center;
    border-top: 1px solid #dee2e6;
  }
</style>
<div id="confirmarEliminar" class="row">
    <span style="display: none;" id="URLbase">{{ route('admin.producto.index') }}</span>
    @include('custom.modal_eliminar')
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sección de Productos</h3>

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
                <a class="btn btn-primary m-2 float-right" href="{{ route('admin.producto.create') }}">Crear Producto</a>
                <table class="table table-head-fixed tabla-1">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Imagen</th>
                      <th>Nombre</th>
                      <th>Estado</th>
                      <th>Activo</th>
                      <th>Slider Principal</th>
                      <th colspan="3"></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($productos as $producto)  
                    <tr>
                      <td>{{ $producto->id }}</td>
                      <td>@if($producto->images->count() <=0 )
                            <img style="width: 100px; height: 100px;" src="/imagenes/avatar.png" class="rounded-circle">
                          @else
                            <img style="width: 100px; height: 100px;" src="{{ $producto->images->random()->URL }}" class="rounded-circle">
                          @endif           
                      </td>
                      <td>{{ $producto->Nombre }}</td>
                      <td>{{ $producto->Estado }}</td>
                      <td>{{ $producto->Activo }}</td>
                      <td>{{ $producto->SliderPrincipal }}</td>
                      <td><a class="btn btn-default" href="{{ route('admin.producto.show', $producto->Slug) }}">Ver</a></td>
                      <td><a class="btn btn-info" href="{{ route('admin.producto.edit', $producto->Slug) }}">Editar</a></td>
                      <td><a class="btn btn-danger" href="{{ route('admin.producto.index') }}"
                        v-on:click.prevent="deseas_eliminar({{ $producto->id }})">Eliminar</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                {{ $productos->appends($_GET)->links() }}
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
@endsection