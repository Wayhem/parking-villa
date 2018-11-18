<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Ventas Laravel Vue Js- IncanatoIT">
    <meta name="author" content="Jose Villarroel">
    <meta name="keyword" content="Prueba">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Prueba</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Main css -->
    <link href="css/template.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
   <div id="app">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav ml-auto">
        </ul>
    </header>

    <div class="app-body">
        @include('plantillas.sidebar')
        <!-- Contenido Principal -->
        @yield('content')
        <!-- /Fin del contenido principal -->
    </div>
    </div>
    <footer class="app-footer">
        <span></span>
        <span class="ml-auto">Desarrollado por Jose Villarroel</span>
    </footer>

    <script src="js/app.js"></script>
    <!-- Main JS -->
    <script src="js/template.js"></script>
</body>

</html>