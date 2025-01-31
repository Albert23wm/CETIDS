<script>
    function confirmLogout() {
        Swal.fire({
            title: '¿Cerrar sesión?',
            text: '¿Estás seguro de que deseas cerrar tu sesión?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cerrar sesión',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirigir al usuario a la página de cierre de sesión
                window.location.href = '../controllers/cerrarSesion.php';
            }
        });
    }
</script>

<div class="offcanvas offcanvas-end text-bg-white"
    style="background: linear-gradient(to bottom, #611232, #611232,#611232); margin-bottom: 0;" tabindex="-1"
    id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-white" id="offcanvasDarkNavbarLabel">Menú</h5>
        <i class='bx bx-x-circle' style='color:#ffffff; font-size: 50px; display: none;'></i>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body text-center">
        <ul class="navbar-nav" style="flex-direction: column; align-items: center;">

            <li class="nav-item">
                <a class="nav-link active text-white" href="talleres.php"
                    style="display: flex; align-items: center; flex-direction: column;">
                    <i class='bx bxs-book-alt sombra' style='color:#ffffff; font-size: 70px;'></i>
                    <span style="font-size: 20px;">Talleres</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link active text-white" href="ponentes.php"
                    style="display: flex; align-items: center; flex-direction: column;">
                    <i class='bx bxs-book-reader sombra' style='color:#ffffff; font-size: 70px;'></i>
                    <span style="font-size: 20px;">Participantes</span>
                </a>
            </li>
            <!--  -->
            <li class="nav-item">
                <a class="nav-link active text-white" href="actividades.php"
                    style="display: flex; align-items: center; flex-direction: column;">
                    <i class='bx bx-calendar sombra' style='color:#fffcfc; font-size: 70px;'></i>
                    <span style="font-size: 20px;">Actividades</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link active text-white" href="convocatorias.php"
                    style="display: flex; align-items: center; flex-direction: column;">
                    <i class='bx bx-clipboard sombra' style='color:#ffffff; font-size: 70px;'></i>
                    <span style="font-size: 20px;">Convocatorias</span>
                </a>
            </li>
            <!--  -->

            <li class="nav-item">
                <a class="nav-link active text-white" href="constancias.php"
                    style="display: flex; align-items: center; flex-direction: column;">
                    <i class='bx bx-receipt sombra' style='color:#ffffff; font-size: 70px;'></i>
                    <span style="font-size: 20px;">Constancias</span>
                </a>
            </li>


        </ul>
        <br>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active text-white" href="#" onclick="confirmLogout()"
                    style="display: flex; align-items: center;">
                    <i class='bx bx-log-out' style='color:#fdb1b1; font-size: 50px;'></i>
                    <span style="font-size: 20px; color:#fdb1b1;">
                        Cerrar sesión
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>