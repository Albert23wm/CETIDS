<header>
    <input type="checkbox" id="btn-menu" />
    <label for="btn-menu">
        <i class='bx bx-menu' style='color:#fffbfb; font-size:50px; '></i>
    </label>
    <nav class="nav menu">

        <div class="container-fluid">

            <div class="row">
                <ul class="nav" style="margin-bottom: 0;">
                    <li class="nav-item">
                        <a href="#Actividades" onclick="cerrar()" class="nav-link text-white" style="margin-right: 20px;">Actividades</a>
                    </li>
                    <li class="nav-item">
                        <a href="#Convocatorias" onclick="cerrar()" class="nav-link text-white" style="margin-right: 20px;">Convocatorias</a>
                    </li>

                    <li class="hide-on-mobile">
                        <a class="navbar-brand">
                            <img id="iso-img" src="assets/img/contenido/Icono_1.png" alt="Logo" width="135" height="130" class="d-inline-block align-text-top">
                        </a>
                    </li>
                    <li class="hide-on-mobile"><a href="#" id="iso-img" class="nav-link text-white"
                            style="margin-right: 50px;">&nbsp;</a></li>

                    <li class="nav-item"><a href="#Participantes" class="nav-link text-white" onclick="cerrar()"
                            style="margin-right: 20px;">Participantes</a></li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false" onclick="cerrar()">
                            Más
                        </a>
                        <div class="dropdown-menu"
                            style="background: linear-gradient(to bottom, #54C0D4CC, #007CA8CC);">
                            <a class="dropdown-item" class="btn btn-primary" data-toggle="modal"
                                data-target="#myModal">¿Cómo
                                llegar?</a>
                            <a class="dropdown-item" href="#Patrocinadores">Patrocinadores</a>
                            <a class="dropdown-item" href="#Contacto">Contacto</a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>