<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Ingresos</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Registro de Ingresos
                        <!-- <button type="button" @click="abrirModal('ingreso', 'registrar')" class="btn-pill btn-primary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button> -->
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="cryteria">
                                      <option value="plate">Placa</option>
                                      <option value="brand">Marca</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarIngreso(1,buscar,cryteria)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarIngreso(1,buscar,cryteria)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Celda Inicial</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ingreso in arrayIngreso" :key="ingreso.id">
                                    <td>
                                        <button type="button" @click="abrirModal('ingreso','actualizar',ingreso)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button v-if="pagination.current_page > 10" type="button" class="btn btn-danger btn-sm" @click="eliminarIngreso(ingreso.id)">
                                             <i class="icon-trash"></i>
                                        </button> 
                                    </td>
                                    <td class="text-uppercase" v-text="ingreso.plate"></td>
                                    <td v-text="ingreso.brand"></td>
                                    <td v-text="ingreso.initc"></td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,cryteria)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, cryteria)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, cryteria)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'show':modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 v-text="tituloModal" class="modal-title"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Placa</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="plate" class="form-control" placeholder="PLACA" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Marca</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="brand" class="form-control" placeholder="MARCA">
                                    </div>
                                </div>
                                <div v-show="errorIngreso" class="form-group row div-error">
                                    <div class="text-center text-error" v-for="error in errorMostrarMsjIngreso" :key="error" v-text="error"></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <!-- <button v-if="tipoAccion==1" type="button" class="btn btn-primary" @click="registrarIngreso()">Guardar</button> -->
                            <button v-if="tipoAccion==2" type="button" class="btn btn-primary" @click="actualizarIngreso()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {
        data(){
            return{
                plate : '',
                brand : '',
                initc : '',
                preciofinal: 0,
                arrayIngreso: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: '',
                errorIngreso: 0,
                errorMostrarMsjIngreso: [],
                ingreso_id: 0, 
                pagination: {
                    'total'             : 0,
                    'current_page'      : 0,
                    'per_page'          : 0,
                    'last_page'         : 0,
                    'from'              : 0,
                    'to'                : 0,
                },
                offset : 3,
                cryteria : 'plate',
                buscar : ''
            }
        },
        computed: {
            // retorna pagina activa para class
            isActived: function(){
                return this.pagination.current_page;
            },
            //calcula pagina final
            pagesNumber: function(){
                if(!this.pagination.to) {
                    return [];
                }
                //limites
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                //listar
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods : {
            listarIngreso (page, buscar, cryteria) {
                let me=this;
                var url = '/ingreso?page=' + page + '&buscar=' + buscar + '&cryteria=' + cryteria;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    console.log(respuesta);
                    if (respuesta.pagination){
                    me.arrayIngreso = respuesta.ingresos.data;
                    me.pagination = respuesta.pagination;
                    } else {
                        me.arrayIngreso = respuesta;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            actualizarIngreso(){
                if(this.validarIngreso()){
                    return;
                }
                let me = this;
                axios.put('/ingreso/'+me.ingreso_id,{
                    'plate': this.plate,
                    'brand': this.brand,
                    'id': this.ingreso_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarIngreso(1, '', 'plate');
                })
                .catch(function (error) {
                    console.log(error);
                });                
            },
            eliminarIngreso(id){
                const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success mx-2',
                cancelButtonClass: 'btn btn-danger mx-2',
                buttonsStyling: false,
                })

                swalWithBootstrapButtons({
                title: '¿Está seguro?',
                text: "¡No va a ser posible revertir la acción!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '¡Si, bórralo!',
                cancelButtonText: '¡No, cancelar!',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;
                    axios.post('/ingreso/destruir',{
                        'id': id
                    }).then(function (response) {
                        me.cerrarModal();
                        me.listarIngreso(1,'','plate');
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    swalWithBootstrapButtons(
                    '¡Borrado!',
                    'El registro ha sido eliminado.',
                    'success'
                    )
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                    'Cancelado',
                    'El archivo está a salvo :)',
                    'error'
                    )
                }
                })                
            },
            validarIngreso(){
                this.errorIngreso = 0;
                this.errorMostrarMsjIngreso = [];
                if(!this.plate) this.errorMostrarMsjIngreso.push('La placa no puede estar vacía.');
                if(this.errorMostrarMsjIngreso.length) this.errorIngreso = 1;
                return this.errorIngreso;
            },
            cambiarPagina(page, buscar, cryteria){
                let me = this;
                me.pagination.current_page = page;
                me.listarIngreso(page, buscar, cryteria);
            },
            cerrarModal(){
                this.modal = 0;
                this.plate = '';
                this.brand = '';
                this.initc = '';
                this.tituloModal = 'Registrar Ingreso';                
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "ingreso":
                    {
                        switch(accion)
                        {
                            case "registrar":
                            {
                                this.modal = 1;
                                this.plate = '';
                                this.brand = '';
                                this.initc = '';
                                this.tituloModal = 'Registrar Ingreso';
                                this.tipoAccion = 1;
                                break;
                            }
                            case "actualizar":
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar Ingreso';
                                this.tipoAccion=2;
                                this.plate = data['plate'];
                                this.brand = data['brand'];
                                this.ingreso_id = data['id'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarIngreso(1,this.buscar,this.cryteria);
        }
    }
</script>