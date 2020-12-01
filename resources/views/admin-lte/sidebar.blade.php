<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-navy elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">

        <span class="brand-text font-weight-light" style="color: #3c8dbc">
            <img src="{{asset("assets/icons/PCshop.jpg")}}" class="brand-image img-circle"
                style="opacity: 1">
            <b>PCshop Apostoles</b>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Bienvenidos</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link">
                        <i class="nav-item fas fa-users"></i>
                        <p>
                            Clientes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('clientes.index')}}" class="nav-link">


                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver Clientes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ (request()->routeIs('tecnicos.*')) ? 'menu-open active' : '' }}">
                    <a href="#" class="nav-link"
                        style="{{ (request()->routeIs('tecnicos.*')) ? 'background-color: #3c8dbc; color: white;' : '' }}">
                        <i class="nav-item fas fa-users"></i>
                        <p>
                            Tecnicos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('tecnicos.index')}}" class="nav-link"
                                style="{{ (request()->routeIs('tecnicos.index')) ? 'color: #3c8dbc;' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver tecnicos</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview {{ (request()->routeIs('equipos.*')) ? 'menu-open active' : '' }}">
                    <a href="#" class="nav-link"
                        style="{{ (request()->routeIs('equipos.*')) ? 'background-color: #3c8dbc; color: white;' : '' }}">
                        <i class="nav-item fas fa-dolly"></i>
                        <p>
                            Equipos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('equipos.index')}}" class="nav-link"
                                style="{{ (request()->routeIs('equipos.index')) ? 'color: #3c8dbc;' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver equipos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('marcas.index')}}" class="nav-link"
                                style="{{ (request()->routeIs('marcas.index')) ? 'color: #3c8dbc;' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver marcas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('tipo_equipos.index')}}" class="nav-link"
                                style="{{ (request()->routeIs('tipo_equipos.index')) ? 'color: #3c8dbc;' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver Tipo Equipos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ (request()->routeIs('recursos.*')) ? 'menu-open active' : '' }}">
                    <a href="#" class="nav-link"
                        style="{{ (request()->routeIs('recursos.*')) ? 'background-color: #3c8dbc; color: white;' : '' }}">
                        <i class="nav-item fas fa-people-carry"></i>
                        <p>
                            Proveedores y Recursos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>


                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('recursos.index')}}" class="nav-link"
                        style="{{ (request()->routeIs('recursos.index')) ? 'color: #3c8dbc;' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver recursos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('proveedores.index')}}" class="nav-link"
                        style="{{ (request()->routeIs('proveedores.index')) ? 'color: #3c8dbc;' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver proveedores</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('marca_recursos.index')}}" class="nav-link"
                        style="{{ (request()->routeIs('marca_recursos.index')) ? 'color: #3c8dbc;' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver marcas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('medidas.index')}}" class="nav-link"
                        style="{{ (request()->routeIs('medidas.index')) ? 'color: #3c8dbc;' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver medidas</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('tipo_recursos.index')}}" class="nav-link"
                        style="{{ (request()->routeIs('tipo_recursos.index')) ? 'color: #3c8dbc;' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver tipo de Recursos</p>
                    </a>
                </li>                <li class="nav-item">
                    <a href="{{route('modelos.index')}}" class="nav-link"
                        style="{{ (request()->routeIs('modelos.index')) ? 'color: #3c8dbc;' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ver modelos</p>
                    </a>
                </li>
                </ul>
                </li>



                 <li class="nav-item has-treeview {{ (request()->routeIs('tipo_movimientos.*')) ? 'menu-open active' : '' }}">
                    <a href="#" class="nav-link"
                        style="{{ (request()->routeIs('tipo_movimientos.*')) ? 'background-color: #3c8dbc; color: white;' : '' }}">
                        <i class="nav-item fas fa-people-carry"></i>
                        <p>
                            Movimientos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>


                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('movimientos.index')}}" class="nav-link"
                            style="{{ (request()->routeIs('movimientos.index')) ? 'color: #3c8dbc;' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ver Movimientos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('tipo_movimientos.index')}}" class="nav-link"
                            style="{{ (request()->routeIs('tipo_movimientos.index')) ? 'color: #3c8dbc;' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ver Tipo Movimientos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('tipo_comprobantes.index')}}" class="nav-link"
                            style="{{ (request()->routeIs('tipo_comprobantes.index')) ? 'color: #3c8dbc;' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ver Tipo Comprobantes</p>
                            </a>
                        </li>

                     </ul>
                 </li>
                 <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-item fas fa-cogs"></i>
                        <p>
                           Mis Servicios
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('mis_servicios.index')}}" class="nav-link"
                                style="{{ (request()->routeIs('mis_servicios.index')) ? 'color: #3c8dbc;' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mis Servicios</p>
                            </a>
                        </li>
                    </ul>
                 </li>
                 <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-item fas fa-cogs"></i>
                        <p>
                           Servicio
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('servicios.index')}}" class="nav-link"
                                style="{{ (request()->routeIs('servicios.index')) ? 'color: #3c8dbc;' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver Servicio</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('tipo_servicios.index')}}" class="nav-link"
                                style="{{ (request()->routeIs('tipo_servicios.index')) ? 'color: #3c8dbc;' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver Tipo de Servicio</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('prioridades.index')}}" class="nav-link"
                                style="{{ (request()->routeIs('prioridades.index')) ? 'color: #3c8dbc;' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver Prioridades</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('estados.index')}}" class="nav-link"
                                style="{{ (request()->routeIs('estados.index')) ? 'color: #3c8dbc;' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver Estados</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('accesorios.index')}}" class="nav-link"
                                style="{{ (request()->routeIs('accesorios.index')) ? 'color: #3c8dbc;' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ver acesorios</p>
                            </a>
                        </li>
                     </ul>
                 </li>
                 <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-item fas fa-cogs"></i>
                        <p>
                           Configuracion
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('configuracion.index')}}" class="nav-link"
                            style="{{ (request()->routeIs('configuracion.index')) ? 'color: #3c8dbc;' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ver Configuracion</p>
                        </a>
                    </li>

                     </ul>
                 </li>
                 <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-item fas fa-cogs"></i>
                        <p>
                           Auditoria
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('auditoria.index')}}" class="nav-link"
                            style="{{ (request()->routeIs('auditoria.index')) ? 'color: #3c8dbc;' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ver Auditorias</p>
                        </a>
                    </li>

                     </ul>
                 </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
