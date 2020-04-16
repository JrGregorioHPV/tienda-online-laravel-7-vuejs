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
</head>
<body>

    <div class="container">
        <div id="app">
            <form action="">
                <h1>Crear Categoría</h1>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input v-model="nombre"
                        @blur = "getCategoria"
                        @focus = "div_aparecer = false"
                    
                    type="text" class="form-control" name="nombre" id="nombre">
                    <label for="slug">Slug</label>
                    <input readonly v-model="generarSlug" type="text" class="form-control" name="slug" id="slug">
                    <div v-if="div_aparecer" v-bind:class="div_claseSlug">
                        {{ div_mensajeSlug }}
                    </div>
                    <br v-if="div_aparecer">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="5"></textarea>
                </div>
                <input 
                :disabled = "deshabilitar_btn == 1"
                type="submit" value="Guardar" class="btn btn-primary float-right">
            </form>
            <br><br>
            {{ nombre }}
            <br>
            {{ generarSlug }}
            <br>
            Slug: {{ slug }}
        </div>
    </div>

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                nombre: 'Gregorio Pineda',
                slug: '',
                div_mensajeSlug: 'Slug existe',
                div_claseSlug: 'badge badge-danger',
                div_aparecer: true,
                deshabilitar_btn: 0
            },
            computed: {
                generarSlug: function(){
                    var caracter = {
                        "á":"a","é":"e","í":"i","ó":"o","ú":"u",
                        "Á":"A","É":"E","Í":"I","Ó":"O","Ú":"U",
                        "ñ":"n","Ñ":"N"," ":"-","_":"-"
                    }
                    var expr = /['áéíóúÁÉÍÓÚÑñ_ ']/g;
                    this.slug = this.nombre.trim().replace(expr, function(e){
                        return caracter[e];
                    }).toLowerCase();

                    return this.slug;
                }
            },
            methods: {
                getCategoria(){
                    let url = 'http://localhost:8080/tiendaonline.com/Sistema/public/api/categoria/' + this.slug;
                    axios.get(url).then(response => {
                        this.div_mensajeSlug = response.data;
                        console.log(this.div_mensajeSlug);
                        if(this.div_mensajeSlug === "Slug disponible"){
                            this.div_claseSlug = "badge badge-success";
                            this.deshabilitar_btn = 0;
                        } else {
                            this.div_claseSlug = "badge badge-danger";
                            this.deshabilitar_btn = 1;
                        }
                        this.div_aparecer = true;
                    })
                }
            }
        })
    </script>
    
</body>
</html>