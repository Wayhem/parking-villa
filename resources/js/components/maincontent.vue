<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Tablero</li>
            </ol>
            <div class="container">
                <div class="d-flex flex-row justify-content-between flex-wrap">
                    <div v-for="slot in cslot" :key="slot.cell" class="col-5 col-md-2 mr-1">
                        <div v-bind:class="{ 'bg-success': slot.free, 'bg-danger': !slot.free  }" class="card text-white">
                            <div class="card-body">
                                <div v-if="!slot.free" v-text="slot.timePrint" class="text-value"></div>
                                <div v-text="slot.cell" class="h5 text-muted text-uppercase font-weight-bold"></div>
                                <small v-if="slot.free" class="text-muted text-uppercase font-weight-bold">vacio</small>
                                <div v-else>
                                    <small v-text="slot.placa" class="text-muted text-uppercase font-weight-bold"></small>
                                    <small v-text="slot.marca" class="text-muted text-uppercase font-weight-bold"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">Acciones 
                                <span v-text="cslot[0].free+cslot[1].free+cslot[2].free+cslot[3].free+cslot[4].free+cslot[5].free+cslot[6].free+cslot[7].free+cslot[8].free+cslot[9].free" class="badge badge-pill badge-success float-right"></span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <a class="btn btn-outline-success btn-lg btn-block mx-2 mb-2" href="#" @click="abrirModal('ingreso')">Ingresos</a>
                                    </div>
                                    <div class="col-md-5">
                                        <button class="btn btn-outline-danger btn-lg btn-block mx-2 mb-2" type="button" @click="abrirModal('salida')">Salidas</button>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <button class="btn btn-sm btn-outline-warning mx-2 mb-2" type="button" @click="inicializarCeldas">Inicializar</button>
                                    </div>
                                </div>      
                            </div>
                        </div>
                    </div>
                </div>
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
                            <form enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Placa</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="plate" class="form-control" placeholder="PLACA" max="10" required @keydown.enter="checkEnter">
                                    </div>
                                </div>
                                <div v-if="tipoAccion==1" class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Marca</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="brand" class="form-control" placeholder="MARCA" max="20"  @keyup.enter="checkEnter">
                                    </div>
                                </div>
                                <div v-if="errorIngreso" class="form-group row div-error">
                                    <div class="text-center text-error">La placa no puede estar vacía.</div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button v-if="tipoAccion==1" type="button" class="btn btn-primary" @click="registrarIngreso()">Guardar</button>
                            <button v-if="tipoAccion==2" type="button" class="btn btn-primary" @click="registrarSalida()">Salida</button>
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
    //var moment = require('moment');
    export default {
        data(){
            return {
                autoIngresado: '',
                celdaAsig: '',
                arrayCode: [],
                currentc: '',
                cslot : [
                    {
                        free: 1,
                        cell: 'c1',
                        placa: '',
                        marca: '',
                        code: 1,
                        time: new Date,
                        timeElapsed: 0,
                        interval: 0,
                        timePrint: ''
                    }, 
                    {
                        free: 1,
                        cell: 'c2',
                        placa: '',
                        marca: '',
                        code: 2,
                        time: new Date,
                        timeElapsed: 0,
                        interval: 0,
                        timePrint: ''
                    },
                    {
                        free: 1,
                        cell: 'c3',
                        placa: '',
                        marca: '',
                        code: 3,
                        time: new Date,
                        timeElapsed: 0,
                        interval: 0,
                        timePrint: ''
                    }, 
                    {
                        free: 1,
                        cell: 'c4',
                        placa: '',
                        marca: '',
                        code: 4,
                        time: new Date,
                        timeElapsed: 0,
                        interval: 0,
                        timePrint: ''
                    },
                    {
                        free: 1,
                        cell: 'c5',
                        placa: '',
                        marca: '',
                        code: 5,
                        time: new Date,
                        timeElapsed: 0,
                        interval: 0,
                        timePrint: ''
                    },
                    {
                        free: 1,
                        cell: 'c6',
                        placa: '',
                        marca: '',
                        code: 6,
                        time: new Date,
                        timeElapsed: 0,
                        interval: 0,
                        timePrint: ''
                    }, 
                    {
                        free: 1,
                        cell: 'c7',
                        placa: '',
                        marca: '',
                        code: 7,
                        time: new Date,
                        timeElapsed: 0,
                        interval: 0,
                        timePrint: ''
                    }, 
                    {
                        free: 1,
                        cell: 'c8',
                        placa: '',
                        marca: '',
                        code: 8,
                        time: new Date,
                        timeElapsed: 0,
                        interval: 0,
                        timePrint: ''
                    }, 
                    {
                        free: 1,
                        cell: 'c9',
                        placa: '',
                        marca: '',
                        code: 9,
                        time: new Date,
                        timeElapsed: 0,
                        interval: 0,
                        timePrint: ''
                    }, 
                    {
                        free: 1,
                        cell: 'c10',
                        placa: '',
                        marca: '',
                        code: 10,
                        time: new Date,
                        timeElapsed: 0,
                        interval: 0,
                        timePrint: ''
                    }],
                plate: '',
                idcelda:'',
                brand: '',
                preciofinal: '',
                modal: 0,
                errorIngreso: 0,
                tituloModal: '',
                tipoAccion: 0,
                cellToTake: '',
                lastOne: 0,
                superid: [],
                now: new Date,
                postedCar: {},
                plateOut: '',
                errorDisponible: 0,
                celdas: []
            }
        },
        created() {
            setInterval(
                () => {
                    for (let i = 0; i < this.cslot.length; i++) {
                        if (this.cslot[i].interval){
                            this.now = new Date
                            this.cslot[i].timeElapsed = Math.abs(this.now - this.cslot[i].time);
                            this.cslot[i].timePrint = this.msToTime(this.cslot[i].timeElapsed)
                        }
                    }
                }, 1000)
        },
        methods: {
            inicializarCeldas(){
                let me = this;
                for (var i=0;i<10;i++){
                    var num = i+1;
                    if(i<5){
                      axios.post('/celda',{
                            'posicion': 0,
                            'codename': num
                        }).then(function (response) {
                            console.log('Ready');
                        })
                        .catch(function (error) {
                            console.log(error);
                        });  
                    } else {
                      axios.post('/celda',{
                            'posicion': 1,
                            'codename': num
                        }).then(function (response) {
                            console.log('Ready');
                        })
                        .catch(function (error) {
                            console.log(error);
                        });                        
                    }
                }
                this.getCeldas();
            },
            getCeldas(response){
                let me = this;
                me.responsepost = response;
                axios.get('/celda').then(function (response) {
                    me.almacenarCelda(response, me.responsepost);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getCeldasErase(response){
                let me = this;
                me.responsepost = response;
                axios.get('/celda').then(function (response) {
                    me.ejecutarSalida(response, me.responsepost);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getCeldasChange(response){
                let me = this;
                me.responsepost = response;
                axios.get('/celda').then(function (response) {
                    me.almacenarCeldaChange(response, me.responsepost);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cerrarModal(){
                this.modal = 0;
                this.plate = '';
                this.brand = '';
                this.initc = '';
            },
            ejecutarSalida(celdas, ingresos){
                let foundCar;
                let me = this;
                let foundCell;
                let obstructorCell;
                let obstructorCar;
                ingresos.data.forEach(function(data){
                    if (data.plate == me.plateOut){
                        foundCar = data;
                    }
                });
                if (!foundCar)
                {
                    swal(
                        'Placa no encontrada',
                        '¿Seguro que es esa?',
                        'question'
                    )
                    return;
                }
                celdas.data.forEach(function(data){
                    if (data.idingreso == foundCar.id){
                        foundCell = data;
                    }
                });
                let timeMs;
                let timeObsMs;
                this.cslot.forEach(function(slot){
                    if (foundCell.codename == slot.code){
                        timeMs = slot.timeElapsed;
                    }
                });
                let num = parseInt(foundCell.codename);
                let num2 = num + 5;
                if (num < 6){
                    for (let i = 0; i < 10; i++) {
                        if (celdas.data[i].codename == num2){
                            if (!celdas.data[i].libre){
                                obstructorCell = celdas.data[i];
                                ingresos.data.forEach(function(data){
                                    if (data.id == obstructorCell.idingreso){
                                        obstructorCar = data;
                                    }
                                });
                                this.cslot.forEach(function(slot){
                                    if (obstructorCell.codename == slot.code){
                                        timeObsMs = slot.timeElapsed;
                                    }
                                });
                                this.cambiarIngreso(obstructorCar);
                                this.liberarCelda(obstructorCell, timeObsMs);
                            }
                        }
                    }
                }
                this.storePrecio(foundCar, timeMs);
                this.liberarCelda(foundCell, timeMs);
            },
            storePrecio(carro, tiempo){
                let me = this;
                let precio = tiempo / 1000 * 30;
                this.displayBoleto(tiempo, precio)
                axios.put('/ingreso/'+carro.id,{
                    'id': carro.id,
                    'preciofinal': precio,
                    'tiempofinal': tiempo,
                    'egresado': 1
                }).then(function (response) {
                    me.getInit();
                    me.reboot();
                })
                .catch(function (error) {
                    console.log(error);
                });
                let tiempoS;
                tiempoS = tiempo/1000;
                let date = new Date;
                date = this.formatDate(date);
                axios.post('/factura', {
                    'tiempo': tiempoS,
                    'fecha': date
                }).then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            displayBoleto(tiempo, precio){
                precio = parseInt(precio);
                let time = this.msToTime(tiempo);
                let string = 'Han transcurrido ' + time + ' por un precio de ' + precio +'$';
                swal(
                    '¡Listo!',
                    string,
                    'success'
                )
            },
            liberarCelda(celda, time){
                let me = this;
                axios.get('/celda').then(function (response) {
                    me.liberarCelda2(celda, time, response);
                })
                .catch(function (error) {
                    console.log(error);
                });  
            },
            liberarCelda2(celda, tiempo, celdas){
                let Time1;
                let aTime;
                let me = this;
                for (let i = 0; i < celdas.data.length; i++) {
                    const element = celdas.data[i];
                    if (celda.id == element.id) {
                        Time1 = element.a_time;
                    }
                }
                aTime = Time1 + tiempo;
                axios.put('/celda/'+celda.id,{
                    'id': celda.id,
                    'libre': 1,
                    'a_time': aTime
                }).then(function (response) {
                    me.cerrarModal();
                    me.reboot();
                    me.getInit();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            validarIngreso(){
                this.errorIngreso = 0;
                if(!this.plate) this.errorIngreso = 1;
                return this.errorIngreso;
            },
            validarDisponible(){
                this.errorDisponible = 1;
                for (let i = 0; i < this.cslot.length; i++) {
                    const element = this.cslot[i].free;
                    if(element) this.errorDisponible = 0;
                }
                return this.errorDisponible;
            },
            cambiarIngreso(obstructorCar){
                this.plate = obstructorCar.plate.toLowerCase();
                this.brand = obstructorCar.brand;
                let me = this;
                while (!this.cellToTake){
                    var num = Math.floor(Math.random()*10);
                    if (this.cslot[num].free){
                        if(num>4){
                            if(this.cslot[num-5].free){
                                this.cellToTake = this.cslot[num-5].cell;
                                this.cslot[num-5].free = 0;
                                this.cslot[num-5].placa = this.plate;
                                this.cslot[num-5].marca = this.brand;
                                this.cslot[num-5].time = new Date;
                                this.lastOne = this.cslot[num-5].code;
                            } else {
                               this.cellToTake = this.cslot[num].cell;
                               this.cslot[num].free = 0;
                               this.cslot[num].placa = this.plate;
                               this.cslot[num].marca = this.brand;
                               this.cslot[num].time = new Date;
                               this.lastOne = this.cslot[num].code;
                            }
                        } else {
                            this.cellToTake = this.cslot[num].cell;
                            this.cslot[num].free = 0;
                            this.cslot[num].placa = this.plate;
                            this.cslot[num].marca = this.brand;
                            this.cslot[num].time = new Date;
                            this.lastOne = this.cslot[num].code; 
                        }
                    }
                }
                this.editCar(obstructorCar,this.cellToTake);
                this.getCeldasChange(obstructorCar);
            },
            editCar(data, cellToTake){
                let me = this;
                axios.put('/ingreso/'+data.id,{
                    'currentc': cellToTake,
                    'id': data.id
                }).then(function (response) {
                })
                .catch(function (error) {
                    console.log(error);
                });                
            },
            registrarIngreso(){
                if(this.validarIngreso()){
                    return;
                }
                if(this.validarDisponible()){
                    swal({
                        type: 'error',
                        title: 'Lo siento...',
                        text: '¡No hay puestos disponibles!'
                    })
                    return;
                }
                this.plate = this.plate.toLowerCase();
                let me = this;
                while (!this.cellToTake){
                    var num = Math.floor(Math.random()*10);
                    if (this.cslot[num].free){
                        if(num>4){
                            if(this.cslot[num-5].free){
                                this.cellToTake = this.cslot[num-5].cell;
                                this.cslot[num-5].free = 0;
                                this.cslot[num-5].placa = this.plate;
                                this.cslot[num-5].marca = this.brand;
                                this.cslot[num-5].time = new Date;
                                this.lastOne = this.cslot[num-5].code;
                            } else {
                               this.cellToTake = this.cslot[num].cell;
                               this.cslot[num].free = 0;
                               this.cslot[num].placa = this.plate;
                               this.cslot[num].marca = this.brand;
                               this.cslot[num].time = new Date;
                               this.lastOne = this.cslot[num].code;
                            }
                        } else {
                            this.cellToTake = this.cslot[num].cell;
                            this.cslot[num].free = 0;
                            this.cslot[num].placa = this.plate;
                            this.cslot[num].marca = this.brand;
                            this.cslot[num].time = new Date;
                            this.lastOne = this.cslot[num].code; 
                        }
                    }
                }
                axios.post('/ingreso',{
                    'plate': this.plate,
                    'brand': this.brand,
                    'initc': this.cellToTake,
                    'currentc': this.cellToTake
                }).then(function (response) {
                    me.cerrarModal();
                    me.getCeldas(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getCeldasFull(){
                let me = this;
                axios.get('/celda').then(function (response) {
                    me.getIngresos(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getIngresos(celdas){
                let me = this;
                me.celdas = celdas;
                axios.get('/ingreso').then(function (response) {
                    me.fixFull(response, me.celdas);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            fixFull(ingresos, celdas){
                let foundCar;
                let me = this;
                let foundCell;
                ingresos.data.forEach(function(data){
                    if (data.plate == me.plateOut){
                        foundCar = data;
                    }
                });
                if (!foundCar)
                {
                    swal(
                        'Placa no encontrada',
                        '¿Seguro que es esa?',
                        'question'
                    )
                    return;
                }
                celdas.data.forEach(function(data){
                    if (data.idingreso == foundCar.id){
                        foundCell = data;
                    }
                });
                let timeMs;
                let timeObsMs;
                this.cslot.forEach(function(slot){
                    if (foundCell.codename == slot.code){
                        timeMs = slot.timeElapsed;
                    }
                });
                let obstructorCell;
                let obstructorCar;
                let num = parseInt(foundCell.codename);
                let num2 = num + 5;
                if (num < 6){
                    for (let i = 0; i < 10; i++) {
                        if (celdas.data[i].codename == num2){
                            obstructorCell = celdas.data[i];
                        }
                    }
                    ingresos.data.forEach(function(ingreso){
                        if (obstructorCell.idingreso == ingreso.id){
                            obstructorCar = ingreso;
                        }
                    });
                    this.cslot.forEach(function(slot){
                        if (obstructorCell.codename == slot.code){
                            timeObsMs = slot.timeElapsed;
                        }
                    });
                    this.liberarCelda(obstructorCell, timeObsMs);
                    this.liberarCeldaObs(foundCell, timeMs, obstructorCar)
                } else {
                    this.liberarCelda(foundCell, timeMs);
                }
                if (obstructorCar) {
                    let cellEdit = 'c'+foundCell.codename;
                    this.editCar(obstructorCar, cellEdit);
                }
                this.storePrecio(foundCar, timeMs);
            },
            liberarCeldaObs(foundCell, timeMs, obstructorCar){
                let me = this;
                axios.get('/celda').then(function (response) {
                    me.liberarCeldaObs2(foundCell, timeMs, obstructorCar, response);
                })
                .catch(function (error) {
                    console.log(error);
                });  
            },
            liberarCeldaObs2(foundCell, timeMs, obstructorCar, response){
                let Time1;
                let aTime;
                let me = this;
                for (let i = 0; i < response.data.length; i++) {
                    const element = response.data[i];
                    if (foundCell.id == element.id) {
                        Time1 = element.a_time;
                    }
                }
                aTime = Time1 + timeMs;
                axios.put('/celda/'+foundCell.id,{
                    'id': foundCell.id,
                    'libre': 1,
                    'a_time': aTime
                }).then(function (response) {
                    me.almacenarCeldaObs(obstructorCar,foundCell);
                    me.cerrarModal();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            registrarSalida(){
                if(this.validarIngreso()){
                    return;
                }
                let me = this;
                this.plate = this.plate.toLowerCase();
                this.plateOut = this.plate;
                if (this.validarDisponible()){
                    this.getCeldasFull();
                } else {
                    let me = this;
                    this.plate = this.plate.toLowerCase();
                    this.plateOut = this.plate;
                    axios.get('/ingreso').then(function (response) {
                        me.getCeldasErase(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            },
            almacenarCeldaObs(car, cell){
                let me = this;
                axios.put('/celda/'+cell.id,{
                    'id': cell.id,
                    'idingreso': car.id,
                    'libre': 0
                }).then(function (response) {
                    me.reboot();
                    me.getInit();
                })
                .catch(function (error) {
                    console.log(error);
                });  
            },
            almacenarCelda(responseget,responsepost){
                let me = this;
                let cellid = 0;
                me.postedCar = responsepost;
                for (let i=0;i<10;i++){
                    if(responseget.data[i].codename == this.lastOne){
                        cellid = responseget.data[i].id;
                    }
                }
                axios.put('/celda/'+cellid,{
                    'id': cellid,
                    'idingreso': responsepost.data.id,
                    'libre': 0
                }).then(function (response) {
                    me.passFoundCarPost(me.postedCar);
                })
                .catch(function (error) {
                    console.log(error);
                });  
            },
            almacenarCeldaChange(responseget,responsepost){
                let me = this;
                let cellid = 0;
                let editedCar = responsepost;
                
                for (let i=0;i<10;i++){
                    if(responseget.data[i].codename == this.lastOne){
                        cellid = responseget.data[i].id;
                    }
                }
                axios.put('/celda/'+cellid,{
                    'id': cellid,
                    'idingreso': responsepost.id,
                    'libre': 0
                }).then(function (response) {
                    me.passFoundCarChange(editedCar);
                })
                .catch(function (error) {
                    console.log(error);
                });  
            },
            abrirModal(modelo){
                switch(modelo){
                    case "ingreso":
                    {
                        this.modal = 1;
                        this.plate = '';
                        this.brand = '';
                        this.tituloModal = 'Registrar Ingreso';
                        this.tipoAccion = 1;
                        break;
                    }
                    case "salida":
                    {
                        this.modal = 1;
                        this.plate = '';
                        this.brand = '';
                        this.tituloModal = 'Registrar Salida';
                        this.tipoAccion = 2;
                        break;
                    }
                }
            },
            formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [year, month, day].join('-');
            },
            getInit(){
                let me = this;
                axios.get('/celda').then(function (response) {
                    me.init(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            init(response){
                let me = this;
                var d = 0;
                for (var i = 0; i < 10; i++){
                    d = response.data[i].codename;
                    this.cslot[d-1].free = response.data[i].libre;
                    if (!this.cslot[d-1].free)
                    {
                        me.superid.push(response.data[i].idingreso);
                    }
                }
                axios.get('/ingreso').then(function (response) {
                    me.updateCells(response, me.superid);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            updateCells(response, idingreso){
                let me = this;
                response.data.forEach(function(data){
                    for (let i = 0; i < idingreso.length; i++) {
                        const element = idingreso[i];
                        if (data.id == element){
                            var foundCar = data;                   
                            me.passFoundCar(foundCar);
                        }
                    }                                  
                });
            },
            passFoundCar(data){
                let date_test = new Date(data.created_at.replace(/-/g,"/"));
                this.cslot.forEach(function(slot){
                    if (slot.cell == data.currentc){
                        slot.marca = data.brand;
                        slot.placa = data.plate;
                        slot.time = date_test;
                        slot.interval = 1;
                    }
                });
                this.reboot();
            },
            passFoundCarPost(data){
                let date_test = new Date(data.data.created_at.replace(/-/g,"/"));
                this.cslot.forEach(function(slot){
                    if (slot.cell == data.data.currentc){
                        slot.marca = data.data.brand;
                        slot.placa = data.data.plate;
                        slot.time = date_test;
                        slot.interval = 1;
                    }
                });
                this.reboot();
            },
            checkEnter(e){
                if(e) e.preventDefault();
                if (this.tipoAccion == 1) {
                    this.registrarIngreso();
                }
                if (this.tipoAccion == 2) {
                    this.registrarSalida();
                }
            },
            passFoundCarChange(data){
                let date_test = new Date(data.created_at.replace(/-/g,"/"));
                this.cslot.forEach(function(slot){
                    //data modeling needed
                    if (slot.cell == data.currentc){
                        slot.marca = data.brand;
                        slot.placa = data.plate;
                        slot.time = date_test;
                        slot.interval = 1;
                    }
                });
                this.cerrarModal();
                this.reboot();
            },
            reboot(){
                this.cellToTake = '';
                this.lastOne = 0;
                this.superid = [];
                this.postedCar = {};
            },
            msToTime(duration) {
                var //milliseconds = parseInt((duration % 1000) / 100),
                    seconds = parseInt((duration / 1000) % 60),
                    minutes = parseInt(duration / (1000 * 60)),
                    //hours = parseInt((duration / (1000 * 60 * 60)) % 24);

                hours = (hours < 10) ? "0" + hours : hours;
                minutes = (minutes < 10) ? "0" + minutes : minutes;
                seconds = (seconds < 10) ? "0" + seconds : seconds;

                return /*hours + ":" + */minutes + ":" + seconds //+ "." + milliseconds;
            },
        },
        mounted() {
            this.getInit();
        }
    }
</script>
