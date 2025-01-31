<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../../assets/img/contenido/Icon.png">
    <title>Agregar ponente</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ALERT -->
    <script src="../../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../../node_modules/@fontsource/poppins/index.css">

    <!-- ICONOS -->
    <link href='../../node_modules/boxicons/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php
    session_start();

    include '../../config/php/autenticacionAdministrador.php';
    include '../../config/php/alertas.php';
    ?>
    <header
        class="d-flex flex-wrap align-items-center justify-content-between py-2 py-md-4 mb-4 border-bottom fixed-top container-fluid"
        style="background: linear-gradient(to bottom,#611232, #611232,#611232); margin-bottom: 0;">

        <div class="col-6 col-md-3 mb-2 mb-md-0 ">
            <a class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="../../assets/img/contenido/LogoUTVM.png" width="150" alt="Logo">
            </a>
        </div>
        <div class="col-12 col-md-6 mb-2 text-center mb-md-0">
            <h5 class="text-white "><b>AGREGAR PARTICIPANTE</b></h5>
        </div>

        <div class="col-6 col-md-3 text-end">
            <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
                style='color:#ffffff; font-size: 50px;'></i>

        </div>
    </header>

    <?php include_once '../../assets/partials/administrador/submenu.php'; ?>

    <br><br><br><br><br><br><br><br>

    <div class="container">
        <form action="../../controllers/admin/ponentes/agregarPonente.php" method="POST" enctype="multipart/form-data"
            autocomplete="off">

            <div class="form-group">
                <label for="nombre_ponente">Nombre del participante:</label>
                <input type="text" class="form-control" id="nombre_ponente" name="nombre_ponente" required>
            </div>

            <div class="form-group">
                <label for="apellido_ponente">Apellido del participante:</label>
                <input type="text" class="form-control" id="apellido_ponente" name="apellido_ponente" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción del participante:</label>
                <input type="text" class="form-control" id="descripcion_ponente" name="descripcion_ponente" required>
            </div>
            <div class="form-group">
                <label for="cupo" class="col-sm-12 col-form-label">Rol:</label>
                <div class="input-group mb-3">
                    <select class="form-select" id="rol" name="rol">
                        <option value="Conferencista">Conferencista</option>
                        <option value="Tallerista">Tallerista interno</option>
                        <option value="Tallerista Externo">Tallerista externo</option>
                        <option value="Egresado">Egresado</option>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label for="apellido_ponente">Fotografía:</label>
                <input type="file" class="form-control" name="imagen_curso" id="imagen_curso" accept="image/*" required>
            </div>

            <br>

            <button type="submit" name="Enviar" class="btn btn-danger">Agregar</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>