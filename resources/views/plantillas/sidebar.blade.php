<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Mantenimiento
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-flag"></i> Movimientos</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a @click="menu=1" class="nav-link" href="#"><i class="icon-arrow-right-circle"></i> Ingresos</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a @click="menu=2" class="nav-link" href="#"><i class="icon-arrow-left-circle"></i> Salidas</a>
                            </li> -->
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Reportes</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a @click="menu=3" class="nav-link" href="i#"><i class="icon-chart"></i> Reporte Celdas</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a @click="menu=4" class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ventas</a>
                            </li> -->
                        </ul>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
