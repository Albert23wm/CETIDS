<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../assets/img/contenido/Icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Inicio de sesión</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../node_modules/@fontsource/poppins/index.css">

    <!-- ICONOS -->
    <link href='../node_modules/boxicons/css/boxicons.min.css' rel='stylesheet'>

    <!-- ESTILOS -->
    <link rel="stylesheet" href="../assets/css/inicioSesion/inicioSesionEstudiante.css">
</head>

<body>
<?php
    session_start();
    include '../config/php/alertas.php';
?>           
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 py-md-4 mb-4 border-bottom  container-fluid" style="background: linear-gradient(to bottom, #611232, #611232,#611232); margin-bottom: 0;">
    <div class="col-12 col-md-3 mb-2 mb-md-0 text-center">
        <a href="../index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
            <img src="../assets/img/contenido/LogoUTVM.png" width="150" alt="logo">
            
        </a>
        <a href="../index.php" class="text-white text-decoration-none">
            <br><i class='bx bx-left-arrow-alt bx-flashing' style='color:#ffffff' ></i>Inicio
        </a>
    </div>

    <div class="col-12 col-md-6 mb-2 text-center">
        <h5 class="text-white"><b>INICIAR SESIÓN COMO ESTUDIANTE</b></h5>
    </div>

    <div class="col-12 col-md-3 text-center mt-2 mt-md-0">
        <a href="../registro.php" class="btn btn-outline-personal  text-white me-2 btn-sm">Registrarse</a>
        <a href="../login.php" class="btn text-white" style="background: linear-gradient(to bottom, #5CE896, #45AB46, #40CB41);">Iniciar sesión</a>
    </div>
</header>

    <br><br><br><br><br><br><br><br><br><br><br>

    <div class="card container marketing text-center" style="width:50%;">
        <div class="image-container">
            <img class="card-img-top sombra s" src="../assets/img/contenido/Onza.png" id="imagen">
        </div>
        <div class="card-body ">
            <form method="POST" action="../controllers/inicioSesion/iniciarSesionEstudiante.php">
                <br>
                <div class="mb-3">
                    <label for="matricula" class="form-label">Matrícula</label>
                    <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Matrícula" onkeypress="return isNumberKey(event)" required>
                </div>

                <script>
                    function isNumberKey(evt) {
                        var charCode = (evt.which) ? evt.which : event.keyCode;
                        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                            return false;
                        }
                        return true;
                    }
                </script>

                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña">
                </div>
                <button type="submit" class="btn text-white"  name="iniciar" id="iniciar" style="background: linear-gradient(to bottom, #0E773F, #0E773F, #00441B);">Iniciar sesión</button>
            </form>
        </div>
    </div>

</body>

</html>
