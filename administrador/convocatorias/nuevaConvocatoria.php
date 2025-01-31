<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../../img/icon.png">
    <title>Nueva convocatoria</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="../../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../../node_modules/@fontsource/poppins/index.css">

    <!-- ICONOS -->
    <link href='../../node_modules/boxicons/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../../assets/img/contenido/Icon.png" type="image/x-icon">
</head>

<body>
    <?php
    session_start();

    include '../../config/php/autenticacionAdministrador.php';
    include '../../config/php/alertas.php';
    ?>
    <header
        class="d-flex flex-wrap align-items-center justify-content-between py-2 py-md-4 mb-4 border-bottom fixed-top container-fluid"
        style="background: linear-gradient(to bottom, #611232, #611232,#611232); margin-bottom: 0;">

        <div class="col-6 col-md-3 mb-2 mb-md-0 ">
            <a class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="../../assets/img/contenido/LogoUTVM.png" width="150" alt="Logo">
            </a>
        </div>
        <div class="col-12 col-md-6 mb-2 text-center mb-md-0">
            <h5 class="text-white "><b>NUEVA CONVOCATORIA</b></h5>
        </div>

        <div class="col-6 col-md-3 text-end">
            <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
                style='color:#ffffff; font-size: 50px;'></i>
        </div>
    </header>

    <?php include '../../assets/partials/administrador/submenu.php'; ?>

    <script src="../../config/js/validarArchivo.js"></script>
    <!--  -->
    <br><br><br><br><br><br>
    <div class="container">
        <br>
        <form method="POST" action="../../controllers/admin/convocatoria/nuevaConvocatoria.php" class="activity-form"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de convocatoria:</label>
                        <select class="form-con form-select" name="categoria" required>
                            <option value="deportiva">Deportiva</option>
                            <option value="cultural">Cultural</option>
                            <option value="talleres">Taller</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="nombre" class="col-sm col-form-label"> Nombre de la convocatoria:</label>
                        <div class="col-sm-12">
                            <input type="text" name="nombre" class="form-control"
                                placeholder="Nombre de la convocatoria" required>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="desCon" class="col-sm col-form-label">Descripción de la convocatoria:</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="descripcion"
                                placeholder="Breve descripción de la convocatoria" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="imagen">Seleccione una imagen (jpg, jpeg, png) no mayor a 3 MB</label>
                        <input type="file" class="form-control" name="imagen" id="imagen" required
                            accept=".jpg, .jpeg, .png" onchange="validateFile(this)">
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="archivo">Seleccione un archivo PDF no mayor a 3 MB</label>
                        <input type="file" class="form-control" name="archivo" id="archivo" required accept=".pdf">

                    </div>
                </div>
            </div>
            <br>

            <input type="submit" name="Guardar" value="Guardar" class="btn btn-danger">

        </form>
    </div>
    <br><br>
</body>

</html>