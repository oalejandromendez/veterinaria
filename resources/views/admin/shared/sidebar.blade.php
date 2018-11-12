<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{route('admin.home')}}" class="site_title"><i class="fa fa-paw"></i>
                <span>{{ config('app.name') }}</span></a>
        </div>
        <!-- menu profile quick info -->
    @include('admin.shared.menuProfile')
    <!-- /menu profile quick info -->

        <br/>

        <div class="clearfix"></div>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{ route('admin.home')}}"><i class="fas fa-home"></i>  Home
                        </a>
                    </li>
                    <li><a href="{{ route('admin.usuarios.index')}}"><i class="fas fa-user-md"></i>  Usuarios
                        </a>
                    </li>
                    <li><a href="{{ route('admin.responsables.index')}}"><i class="fas fa-address-card"></i>  Responsables
                        </a>
                    </li>
                    <li><a href="{{ route('admin.animales.index')}}"><i class="fas fa-crow"></i>  Animales
                        </a>
                    </li>
                    <li><a href="{{ route('admin.epicrisis.index')}}"><i class="fas fa-notes-medical"></i>  Epicrisis
                        </a>
                    </li>
                    <li><a href="{{ route('admin.estados.index')}}"><i class="fas fa-briefcase-medical"></i>  Gestionar Estado
                        </a>
                    </li>

                    <li>
                        <a>
                            <i class="fas fa-clipboard"></i> Reportes de Mejoramiento <span class="fas fa-angle-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="{{ route('admin.graficas.index') }}">
                                <i class="fas fa-hospital"></i> Hospitalizacion</a>
                            </li>
                            <li class="sub_menu"><a href="{{ route('admin.informes.index') }}">
                                <i class="fab fa-studiovinari"></i> Decesos</a>
                            </li>
                            <li class="sub_menu"><a href="{{ route('admin.informes_altas.index') }}">
                                <i class="fas fa-heartbeat"></i> Altas</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>


        </div>
    </div>
</div>
