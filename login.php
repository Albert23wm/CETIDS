<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="assets/img/contenido/Icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Inicio de sesión</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ALERT -->
    <script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="node_modules/@fontsource/poppins/index.css">

    <!-- ICONOS -->
    <link href='node_modules/boxicons/css/boxicons.min.css' rel='stylesheet'>

    <!-- ESTILO -->
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 py-md-4 mb-4 border-bottom container-fluid"
        style="background: linear-gradient(to bottom,#611232, #611232,#611232); margin-bottom: 0;">
        <div class="col-12 col-md-3 mb-2 mb-md-0 text-center">
            <a href="index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="assets/img/contenido/LogoUTVM.png" width="150" alt="logo">
            </a>
            <a href="index.php" class="text-white text-decoration-none">
                <br><i class='bx bx-left-arrow-alt bx-flashing' style='color:#ffffff'></i>Inicio
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2 text-center">
            <h5 class="text-white"><b>INICIO DE SESIÓN</b></h5>
        </div>

        <div class="col-12 col-md-3 text-center mt-2 mt-md-0 header-btns">
            <a href="registro.php" class="btn btn-outline-personal text-white me-2 btn-sm">Registrarse</a>
            <a href="login.php" class="btn text-white"
                style="background: linear-gradient(to bottom, #5CE896, #45AB46, #40CB41);">Iniciar sesión</a>
        </div>
    </header>
    <div class="container marketing text-center">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="image-container">
                    <img class="img-fluid" src="assets/img/contenido/in1.jpg" width="300" alt="Imagen de fondo">
                </div>

                <p class="card-text">Selecciona tu tipo de sesión:</p>

                <div class="d-flex justify-content-center">
                    <a href="inicioSesion/inicioSesionEstudiante.php" class="btn btn-success text-white btn-custom"
                        style="background: linear-gradient(to bottom,#611232, #611232,#611232);">
                        <i class='bx bxs-user'></i>
                        <br>
                        Estudiante
                    </a>
                    <a href="inicioSesion/inicioSesionInvitado.php" class="btn btn-info text-white btn-custom"
                        style="background: linear-gradient(to bottom, #5CE896, #45AB46, #40CB41);">
                        <i class='bx bxs-user'></i>
                        <br>
                        Invitado
                    </a>
                </div>
            </div>
        </div>
    </div>


</body>

</html>