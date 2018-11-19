<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Inicio</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Reporte de Ventas</li>
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
                                    <th>Fecha</th>
                                    <th>Monto Facturado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="factura in arrayFactura" :key="factura.id">
                                    <td v-text="factura.date"></td>
                                    <td v-text="factura.balance"></td>
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
                arrayFactura: [],
            }
        },
        methods : {
            listarFacturas () {
                let me = this;
                axios.get('/factura').then(function (response) {
                    console.log(response);
                    me.arrayFactura = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        },
        mounted() {
            this.listarFacturas();
        }
    }
</script>