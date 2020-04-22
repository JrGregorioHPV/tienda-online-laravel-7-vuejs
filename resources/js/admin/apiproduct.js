const apiproduct = new Vue({
    el: '#apiproduct',
            data: {
                nombre: '',
                slug: '',
                div_mensajeSlug: 'Slug existe',
                div_claseSlug: 'badge badge-danger',
                div_aparecer: false,
                deshabilitar_btn: 1,
                // Variables de Precio
                precioAnterior: 0,
                precioActual: 0,
                descuento: 0,
                porcentajedeDescuento: 0,
                descuento_mensaje: '0'
            },
            computed: {
                generarSlug: function(){
                    var caracter = {
                        "á":"a","é":"e","í":"i","ó":"o","ú":"u",
                        "Á":"A","É":"E","Í":"I","Ó":"O","Ú":"U",
                        "ñ":"n","Ñ":"N"," ":"-","_":"-"
                    }
                    var expr = /[áéíóúÁÉÍÓÚÑñ_ ]/g;
                    this.slug = this.nombre.trim().replace(expr, function(e){
                        return caracter[e];
                    }).toLowerCase();

                    return this.slug;
                },
                // Funcion de Precio
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
            },
            methods: {
                getProducto(){
                    if(this.slug){
                        let url = '/api/producto/' + this.slug;
                        axios.get(url).then(response => {
                        this.div_mensajeSlug = response.data;
                        if(this.div_mensajeSlug === "Slug disponible"){
                            this.div_claseSlug = 'badge badge-success';
                            this.deshabilitar_btn = 0;
                        } else {
                            this.div_claseSlug = 'badge badge-danger';
                            this.deshabilitar_btn = 1;
                        }
                        this.div_aparecer = true;
                    });
                    } else {
                        this.div_claseSlug = 'badge badge-danger';
                        this.div_mensajeSlug === "Debes escribir un producto";
                        this.deshabilitar_btn = 1;
                        this.div_aparecer = true;
                    }
                    
                }
            },
            mounted(){
                if(dataInfo.editar == 'Si'){
                    this.nombre = dataInfo.datos.nombre;
                    this.precioAnterior = dataInfo.datos.precioanterior;
                    this.porcentajedeDescuento = dataInfo.datos.porcentajedescuento;
                    this.deshabilitar_btn = 0;
                }

                console.log('Nombre: '+this.nombre);
            }
});