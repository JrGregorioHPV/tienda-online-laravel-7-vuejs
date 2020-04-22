@extends('plantilla.admin')

@section('titulo', 'Editar Producto')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.producto.index') }}">Productos</a></li>
    <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('estilos')
<!-- Select2 -->
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('script')
<!-- Select2 -->
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<!-- Ckeditor Js -->
<script src="/adminlte/ckeditor/ckeditor.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('#CategoriaId').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  });
</script>

<script>
    window.dataInfo = {
        editar: 'Si',
        datos: {
            'nombre': '{{ $producto->Nombre }}',
            'precioanterior': '{{ $producto->Precio_Anterior }}',
            'porcentajedescuento': '{{ $producto->Porcentaje_Descuento }}',
        }
    }
</script>
@endsection

@section('contenido')

<div id="apiproduct">
<form action="{{ route('admin.producto.store') }}" method="POST" enctype="multipart/form-data" >
@csrf

  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->

      <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Datos generados automáticamente</h3>

           
          </div>
          <!-- /.card-header -->
          <div class="card-body">

             <div class="row">
              <div class="col-md-6">
                <div class="form-group">

                  <label>Visitas</label>
                  <input  class="form-control" type="number" id="Visitas" name="Visitas"
                  readonly value="{{ $producto->Visitas }}">

                 
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">

                  <label>Ventas</label>
                  <input class="form-control" type="number" id="Ventas" name="Ventas" 
                  readonly value="{{ $producto->Ventas }}">
                </div>
                <!-- /.form-group -->
    
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->




          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
        </div>
        <!-- /.card -->

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Datos del Producto</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">

                  <label>Nombre</label>
                  <input class="form-control"
                  v-model="nombre"
                        @blur = "getProducto"
                        @focus = "div_aparecer = false"
                   type="text" id="Nombre" name="Nombre">

                  <label>Slug</label>
                  <input class="form-control" 
                  readonly v-model="generarSlug"
                  type="text" id="Slug" name="Slug" >

                  <div v-if="div_aparecer" v-bind:class="div_claseSlug">
                        @{{ div_mensajeSlug }}
                    </div>
                    <br v-if="div_aparecer">
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">




                  <label>Categoria</label>
                  <select name="CategoriaId" id="CategoriaId" class="form-control" style="width: 100%;">
                    @foreach($categorias as $categoria)
                    
                     @if ($categoria->id == $producto->Categoria_Id)
                        <option value="{{ $categoria->id }}" selected="selected">{{ $categoria->Nombre }}</option>
                     @else
                        <option value="{{ $categoria->id }}">{{ $categoria->Nombre }}</option>
                     @endif
                    @endforeach


                  </select>
                  <label>Cantidad</label>
                  <input class="form-control" type="number" id="Cantidad" name="Cantidad" 
                  readonly value="{{ $producto->Cantidad }}">
                </div>
                <!-- /.form-group -->
    
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->


          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           
        </div>
      </div>

        <!-- /.card -->



        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Sección de Precios</h3>

            
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">



              <div class="col-md-3">
                <div class="form-group">

                  <label>Precio anterior</label>
                  


                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input v-model="precioAnterior" class="form-control" type="number" id="PrecioAnterior" name="PrecioAnterior" min="0" value="0" step=".01">                 
                </div>
                 
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->



              <div class="col-md-3">
                <div class="form-group">

                  <label>Precio actual</label>
                   <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input v-model="precioActual" class="form-control" type="number" id="PrecioActual" name="PrecioActual" min="0" value="0" step=".01">                 
                </div>

                <br>
                <span id="descuento">
                Descuento: @{{ generarDescuento }}
                </span>
                </div>
                <!-- /.form-group -->
    
              </div>
              <!-- /.col -->




              <div class="col-md-6">
                <div class="form-group">

                  <label>Porcentaje de descuento</label>
                   <div class="input-group">                  
                  <input v-model="porcentajedeDescuento" class="form-control" type="number" id="PorcentajedeDescuento" name="PorcentajedeDescuento" step="any" min="0" max="100" value="0" >    
                  <div class="input-group-prepend">
                    <span class="input-group-text">%</span>
                  </div>  

                </div>

                <br>
                <div class="progress">
                    <div id="barraprogreso" class="progress-bar" role="progressbar" 
                     
                    v-bind:style="{width: porcentajedeDescuento + '%'}"
                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">@{{ porcentajedeDescuento }}%</div>
                </div>
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->


            </div>
            <!-- /.row -->
            </div>
          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
        </div>
        <!-- /.card -->

   <div class="row">
          <div class="col-md-6">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Descripciones del Producto</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label>Descripción corta:</label>

                  <textarea class="form-control ckeditor" name="Descripcion_Corta" id="Descripcion_Corta" rows="3">
                  {!! $producto->Descripcion_Corta !!}</textarea>
                
                </div>
                <!-- /.form group -->

               <div class="form-group">
                  <label>Descripción larga:</label>

                  <textarea class="form-control ckeditor" name="Descripcion_Larga" id="Descripcion_Larga" rows="5">
                  {!! $producto->Descripcion_Larga !!}
                  </textarea>
                
                </div>                

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

       </div>
        <!-- /.col-md-6 -->




          <div class="col-md-6">

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Especificaciones y otros datos</h3>
              </div>
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label>Especificaciones:</label>

                  <textarea class="form-control ckeditor" name="Especificaciones" id="Especificaciones" rows="3">
                  {!! $producto->Especificaciones !!}
                  </textarea>
                
                </div>
                <!-- /.form group -->

               <div class="form-group">
                  <label>Datos de interes:</label>

                  <textarea class="form-control ckeditor" name="Datos_de_Interes" id="Datos_de_Interes" rows="5">
                  {!! $producto->Datos_de_Interes !!}
                  </textarea>
                
                </div>                

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

       </div>
        <!-- /.col-md-6 -->



      </div>
      <!-- /.row -->




         <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Imágenes</h3>

           
          </div>
          <!-- /.card-header -->
          <div class="card-body">

            <div class="form-group">
                
               <label for="Imagenes">Añadir imágenes</label> 
                              
               <input type="file" class="form-control-file" name="Imagenes[]" id="Imagenes[]" multiple 
               accept="image/*" >
            </div>
            <div class="description">
            Un número limitado de archivos pueden ser cargados en este campo.
            <br>
            Limite de 2048 MB por imagen
            <br>
            Tipos permitidos: jpeg, png, jpg, dif, svg.
            <br>
            </div>
            
          </div>


          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
        </div>
        <!-- /.card -->


      <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Administración</h3>
          </div>
          <!-- /.card-header -->
      <div class="card-body">

       <div class="row">
              <div class="col-md-6">
                <div class="form-group">

                  <label>Estado</label>
                  <input  class="form-control" type="text" id="Estado" name="Estado" value="{{ $producto->Estado }}">

                 
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                    <!-- checkbox -->
                    <div class="form-group clearfix">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="Activo" name="Activo"
                        @if($producto->Activo == 'Si')
                            checked
                        @endif
                        >
                        <label class="custom-control-label" for="Activo">Activo</label>
                     </div>

                    </div>

                    <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="SliderPrincipal" name="SliderPrincipal"
                      @if($producto->SliderPrincipal == 'Si')
                            checked
                        @endif
                        >
                      <label class="custom-control-label" for="SliderPrincipal">Aparece en el Slider principal</label>
                    </div>
                  </div>

                  </div>

                

       </div>
            <!-- /.row -->
       <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                   <a class="btn btn-danger" href="{{ route('cancelar','admin.producto.index') }}">Cancelar</a>
                   <input
                   :disabled = "deshabilitar_btn == 1"                
                  type="submit" value="Guardar" class="btn btn-primary">
                 
                </div>
                <!-- /.form-group -->
                
              </div>
              <!-- /.col -->

       </div>
            <!-- /.row -->

          </div>

          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
        </div>
        <!-- /.card -->



      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </form>
</div>
@endsection