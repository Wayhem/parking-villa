@extends('main')
@section('content')
    <template v-if="menu==0">
        <maincontent></maincontent>
    </template>
    <template v-if="menu==1">
        <ingresos></ingresos>
    </template>
    <template v-if="menu==2">
        <salidas></salidas>
    </template>
    <template v-if="menu==3">
        <celdas></celdas>
    </template>
    <template v-if="menu==4">
        <facturas></facturas>
    </template>
@endsection