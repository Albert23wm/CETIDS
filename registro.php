<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="assets/img/contenido/Icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Registro</title>

    <!-- ALERT -->
    <script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="node_modules/@fontsource/poppins/index.css">

    <!-- ICONOS -->
    <link href='node_modules/boxicons/css/boxicons.min.css' rel='stylesheet'>

    <!-- ESTILO -->
    <link rel="stylesheet" href="assets/css/registro.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

    <!-- SCRIPTS -->
    <script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 py-md-4 mb-4 border-bottom fixed-top container-fluid"
        style="background: linear-gradient(to bottom, #611232, #611232,#611232); margin-bottom: 0;">
        <div class="col-12 col-md-3 mb-2 mb-md-0 text-center">
            <a href="../index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="assets/img/contenido/LogoUTVM.png" width="150" alt="logo">

            </a>
            <a href="../index.php" class="text-white text-decoration-none">
                <br><i class='bx bx-left-arrow-alt bx-flashing' style='color:#ffffff'></i>Inicio
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2 text-center">
            <h5 class="text-white"><b>REGISTRO AL CONGRESO ESTATAL</b></h5>
        </div>
    
        <div class="col-12 col-md-3 text-center mt-2 mt-md-0">
            <a href="registro.php" class="btn btn-outline-personal text-white me-2 btn-sm">Registrarse</a>
            <a href="login.php" class="btn text-white"
                style="background: linear-gradient(to bottom, #5CE896, #45AB46, #40CB41);">Iniciar sesión</a>
        </div>
    </header>
    
    <script>
        function preguntarRol() {
            Swal.fire({
                title: '¿Eres estudiante o invitado?',
                html: '<img src="assets/img/contenido/OnzaUTVM.png" style="max-width: 50%;" alt="Imagen de pregunta">', // Agrega la ruta correcta de tu imagen

                showCancelButton: true,
                confirmButtonText: 'Estudiante',
                cancelButtonText: 'Invitado',
                confirmButtonColor: '#611232', // Color verde para el botón de Estudiante
                cancelButtonColor: '#6c757d', // Color gris para el botón de Invitado
            }).then((result) => {
                if (result.isConfirmed) {
                    // El usuario eligió "Estudiante"
                    window.location.href = 'registro/registroEstudiante.php';
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // El usuario eligió "Invitado"
                    window.location.href = 'registro/registroInvitado.php';
                }
            });
        }

        // Llamar a la función al cargar la página
        window.onload = preguntarRol;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <br><br><br><br><br><br><br><br>
    <center><img class="card-img-top" src="assets/img/contenido/R1.jpg" alt="Imagen de fondo" style="width:90%;"></center>

</body>

</html>