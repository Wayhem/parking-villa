<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Reporte de Celdas</li>
            </ol>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Celdas más ocupadas
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Celda</th>
                                    <th>Tiempo Acumulado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="celda in arrayCelda" :key="celda.id">
                                    <td class="text-uppercase" v-text="'c' + celda.codename"></td>
                                    <td v-text="msToTime(celda.a_time)"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
</template>

<script>
    export default {
        data(){
            return{
                arrayCelda: [],
                arrayNum:[],
                usedKey:[],
                goOn: 1
            }
        },
        methods : {
            listarCeldas () {
                let me=this;
                axios.get('/celda').then(function (response) {
                    for (let i = 0; i < response.data.length; i++) {
                        const element = response.data[i];
                        me.arrayNum.push(response.data[i].a_time);
                    }
                    me.arrayNum.sort(function(a, b){return b - a});
                    for (let y = 0; y < me.arrayNum.length; y++) {
                        for (let i=0;i<response.data.length;i++) {
                            for (let d = 0; d < me.usedKey.length; d++) {
                                if (response.data[i].codename == me.usedKey[d]){
                                    me.goOn = 0;
                                    break;
                                }
                            }
                            if(!me.goOn){
                                me.goOn = 1;
                                continue;
                            }
                            if (response.data[i].a_time == me.arrayNum[y]){
                                me.arrayCelda.push(response.data[i])
                                me.usedKey.push(response.data[i].codename);
                                break;
                            }
                        }
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            msToTime(duration) {
                var //milliseconds = parseInt((duration % 1000) / 100),
                    seconds = parseInt((duration / 1000) % 60),
                    minutes = parseInt(duration / (1000 * 60) % 60),
                    hours = parseInt((duration / (1000 * 60 * 60)));

                hours = (hours < 10) ? "0" + hours : hours;
                minutes = (minutes < 10) ? "0" + minutes : minutes;
                seconds = (seconds < 10) ? "0" + seconds : seconds;

                return hours + ":" + minutes + ":" + seconds //+ "." + milliseconds;
            }
        },
        mounted() {
            this.listarCeldas();
        }
    }
</script>