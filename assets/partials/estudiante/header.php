<header
    class="d-flex flex-wrap align-items-center justify-content-between py-2 py-md-4 mb-4 border-bottom fixed-top container-fluid"
    style="background: linear-gradient(to bottom, #611232, #611232,#611232); margin-bottom: 0;">

    <div class="col-6 col-md-3 mb-2 mb-md-0 ">

        <a class="d-inline-flex link-body-emphasis text-decoration-none">

            <img src="../assets/img/contenido/LogoUTVM.png" width="150" alt="Logo">

        </a>

    </div>

    <div class="col-12 col-md-6 mb-2 text-center mb-md-0">

        <h5 class="text-white "><b>TALLERES</b></h5>

    </div>

    <div class="col-6 col-md-3 text-end">

        <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
            style='color:#ffffff; font-size: 50px;'>
        </i>
    </div>
</header>

<script>
    function confirmLogout() {
        Swal.fire({
            title: '¿Cerrar sesión?',
            text: '¿Estás seguro de que deseas cerrar tu sesión?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#A12043',
            cancelButtonColor: '#008735',
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
                <a class="nav-link active text-white" href="misTalleres.php"
                    style="display: flex; align-items: center; flex-direction: column;">

                    <i class='bx bxs-book-add' style='color:#fdfdfd; font-size: 70px;'></i>

                    <span style="font-size: 20px;">Mis talleres</span>
                </a>
            </li>

            <br>

            <li class="nav-item">
                <a class="nav-link active text-white" href="reconocimiento.php"
                    style="display: flex; align-items: center; flex-direction: column;">

                    <i class='bx bxs-star' style='color:#fdfdfd; font-size: 70px;'></i>

                    <span style="font-size: 20px;">Reconocimientos</span>

                </a>
            </li>

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
        </ul>
    </div>
</div>