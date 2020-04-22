<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost:8080/tiendaonline.com/Sistema/public/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="http://localhost:8080/tiendaonline.com/Sistema/public/js/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="http://localhost:8080/tiendaonline.com/Sistema/public/js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="http://localhost:8080/tiendaonline.com/Sistema/public/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="http://localhost:8080/tiendaonline.com/Sistema/public/js/vue.js"></script>
    <script src="http://localhost:8080/tiendaonline.com/Sistema/public/js/axios.js"></script>
    <script src="http://localhost:8080/tiendaonline.com/Sistema/public/js/sweetalert2@9.js"></script>
</head>
<body>

    <div class="container">
        <div id="app">
        <br><br><br><br>

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
                Descuento: {{ generarDescuento }}
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
                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">{{ porcentajedeDescuento }}%</div>
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
        </div>
    </div>

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                precioAnterior: 0,
                precioActual: 0,
                descuento: 0,
                porcentajedeDescuento: 0,
                descuento_mensaje: '0'
            },
            computed: {
                generarDescuento: function(){

                  if (this.porcentajedeDescuento > 100) {
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'No puedes poner un valor mayor a 100'
                    });
                    this.porcentajedeDescuento = 100;
                    this.descuento = (this.precioAnterior * this.porcentajedeDescuento) / 100;
                    this.precioActual = this.precioAnterior - this.descuento;
                    this.descuento_mensaje = 'Este producto tiene el 100% de descuento, por ende es gratis';
                    return this.descuento_mensaje;
                  } else {
                    if (this.porcentajedeDescuento < 0) {
                      Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'No puedes poner un valor menor a 0'
                    });
                      this.porcentajedeDescuento = 0;
                      this.descuento = (this.precioAnterior * this.porcentajedeDescuento) / 100;
                      this.precioActual = this.precioAnterior - this.descuento;
                      this.descuento_mensaje = '';
                      return this.descuento_mensaje;
                    }
                  }

                    if (this.porcentajedeDescuento > 0) {
                        this.descuento = (this.precioAnterior * this.porcentajedeDescuento) / 100;
                        this.precioActual = this.precioAnterior - this.descuento;
                        
                        if (this.porcentajedeDescuento == 100) {
                            this.descuento_mensaje = 'Este producto tiene el %100 de descuento, por ende es gratis';
                        } else {
                            this.descuento_mensaje = 'Hay un descuento de $US' + this.descuento;this.descuento_mensaje = 'Hay un descuento de $US' + this.descuento;
                        }
                        return this.descuento_mensaje;                  
                    } else {
                        this.descuento = '';
                        this.precioActual = this.precioAnterior;
                        
                            this.descuento_mensaje = '';
                                                
                        return this.descuento_mensaje; 
                        }
                    

                    

                }
            }
        })
    </script>
    
</body>
</html>