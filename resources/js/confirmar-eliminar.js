const confirmarEliminar = new Vue({
    el: '#confirmarEliminar',
            data: {
                urleliminar: ''
            },
            methods: {
                deseas_eliminar(Id){
                    this.urleliminar = document.getElementById('URLbase').innerHTML +'/'+Id;
                    $('#modalEliminar').modal('show');
                }
            },
});