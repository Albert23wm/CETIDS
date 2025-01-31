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
                window.location.href = '../index.php';
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