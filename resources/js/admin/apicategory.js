const apicategory = new Vue({
    el: '#apicategory',
            data: {
                nombre: '',
                slug: '',
                div_mensajeSlug: 'Slug existe',
                div_claseSlug: 'badge badge-danger',
                div_aparecer: false,
                deshabilitar_btn: 1
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
                }
            },
            methods: {
                getCategoria(){
                    if(this.slug){
                        let url = '/api/categoria/' + this.slug;
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
                        this.div_mensajeSlug === "Debes escribir una categoría";
                        this.deshabilitar_btn = 1;
                        this.div_aparecer = true;
                    }
                    
                }
            },
            mounted(){
                if(document.getElementById('editar')){
                    this.nombre = document.getElementById('nombreTemp').innerHTML;
                    this.deshabilitar_btn = 0;
                }
            }
});