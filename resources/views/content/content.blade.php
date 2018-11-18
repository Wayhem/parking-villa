@extends('main')
@section('content')
    <template v-if="menu==0">
        <maincontent></maincontent>
    </template>
    <template v-if="menu==1">
        <ingresos></ingresos>
    </template>
@endsection