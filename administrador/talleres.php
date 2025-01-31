<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Talleres</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../node_modules/@fontsource/poppins/index.css">

    <!-- ICONOS -->
    <link href='../node_modules/boxicons/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="../assets/img/contenido/Icon.png">
</head>

<body>
    <?php
    session_start();

    include '../config/php/autenticacionAdministrador.php';
    include '../config/php/alertas.php';
    ?>

    <header
        class="d-flex flex-wrap align-items-center justify-content-between py-2 py-md-4 mb-4 border-bottom fixed-top container-fluid"
        style="background: linear-gradient(to bottom,#611232, #611232,#611232); margin-bottom: 0;">

        <div class="col-6 col-md-3 mb-2 mb-md-0 ">
            <a class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="../assets/img/contenido/LogoUTVM.png" width="150" alt="Logo">
            </a>
        </div>
        <div class="col-12 col-md-6 mb-2 text-center mb-md-0">
            <h5 class="text-white "><b id="title-header">TALLERES</b></h5>
        </div>

        <div class="col-6 col-md-3 text-end">
            <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
                style='color:#ffffff; font-size: 50px;'>
            </i>
        </div>
    </header>

    <?php include_once "../assets/partials/administrador/menu.php"; ?>

    <br><br><br><br><br><br>

    <main>
        <div class="container marketing text-center">
            <a href="talleres/agregarTaller.php" style="text-align: right;">
                <img src="../assets/img/contenido/añadir.png" width="8%">
            </a>

            <h5 class="text-center" style="color:#611232;"><b>Nuevo taller</b></h5>

            <br><br>
            <h2 name="estudiante">¡Bienvenid@ <b>Administrador</b>!</h2>
            <div class="row justify-content-center">
                <?php
                // Conexión a la base de datos
                include("../config/php/conexion.php");

                require('../vendor/setasign/fpdf/fpdf.php');

                // Consulta SQL para obtener los talleres
                $consulta = "SELECT t.*, p.nombre AS nombrePonente, p.apellido FROM talleres t
                    INNER JOIN ponentes p ON t.id_ponente = p.id;
                ";
                $resultado = mysqli_query($conexion, $consulta);

                $filas = [];
                while ($fila = mysqli_fetch_array($resultado)) {
                    $filas[] = $fila;
                }

                // Mostrar las tarjetas de los talleres
                foreach ($filas as $fila): ?>
                    <div class="card"
                        style="width: 18rem; margin-right: 20px; margin-bottom: 20px; background: linear-gradient(45deg, rgba(0, 0, 0, 0.514) 0%, rgba(0, 0, 0, 0.596) 100%), url(../<?php echo $fila['ruta_imagen']; ?>); background-size: cover;">
                        <div class="card-img-bg" style="filter: grayscale(100%);"></div>
                        <div class="card-body">
                            <br><br>
                            <h2 class="card-title text-white"><b>
                                    <?php echo $fila['nombre'] ?>
                                </b></h2>
                            <p class="card-text text-white text-capitalize">Ponente: <br>
                                <?php echo $fila['nombrePonente']; ?>
                            </p>
                            <p class="card-text text-white">Cupo:
                                <?php echo $fila['cupo']; ?>
                            </p>
                            <a data-bs-toggle="modal" data-bs-target="#editarTallerModal<?php echo $fila['id']; ?>">
                                <i class="bx bx-edit" style="color:#ba6057; font-size: 50px;"></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#eliminarTallerModal<?php echo $fila['id']; ?>">
                                <i class="bx bxs-trash" style="font-size: 50px; color:#FFBDB7;"></i>
                            </a>

                            <br><br>
                            <button type="button" class="btn text-white" style="border-color: #ffffff;"
                                data-bs-toggle="modal" data-bs-target="#proyectoModal<?php echo $fila['id']; ?>">Ver
                                detalles
                            </button>
                        </div>
                    </div>
                    <br>

                    <div class="modal fade" id="proyectoModal<?php echo $fila['id']; ?>" tabindex="-1"
                        aria-labelledby="proyectoModalLabel<?php echo $fila['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="proyectoModalLabel<?php echo $fila['id']; ?>">Detalles del
                                        taller
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <br>
                                    <h2 style="color:#A12043"><b>
                                            <?php echo $fila['nombre']; ?>
                                        </b></h2>
                                    <br><br><b style="color:#008735">Descripción del curso: </b><br>
                                    <?php echo $fila['descripcion']; ?>
                                    </p>
                                    </p>
                                    <b style="color:#008735">Cupos disponibles:</b><b>
                                        <p style="color:#A12043">
                                            <?php echo $fila['cupo']; ?>
                                    </b></p>
                                    <br><b style="color:#008735">Código QR de la asistencia: </b><br>
                                    <?php
                                    $ruta_qr = $fila['ruta_qr'];

                                    $ruta_qr_completa = "../" . $ruta_qr;
                                    ?>
                                    <img src="<?php echo $ruta_qr_completa; ?>" width="100%" alt="Código QR del taller">
                                    <br>
                                    <a href="../controllers/admin/talleres/imprimirQR.php?id_taller=<?php echo $fila['id']; ?>"
                                        target="_blank" class="btn" style="border-color: grey;">Imprimir PDF</a>
                                    </a>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn text-white"
                                        style="background: linear-gradient(to bottom, #0E773F, #008735,#035223);"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php foreach ($filas as $fila): ?>
                <!-- Modal para Editar Taller -->
                <div class="modal fade" id="editarTallerModal<?php echo $fila['id']; ?>" tabindex="-1" role="dialog"
                    aria-labelledby="editarTallerModalLabel<?php echo $fila['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarTallerModalLabel<?php echo $fila['id']; ?>">
                                    Editar Taller: <?php echo $fila['nombre']; ?>
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../controllers/admin/talleres/editarTaller.php" method="POST"
                                    enctype="multipart/form-data">
                                    <?php include 'talleres/editarTaller.php'; ?>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para Eliminar Taller -->
                <div class="modal fade" id="eliminarTallerModal<?php echo $fila['id']; ?>" tabindex="-1" role="dialog"
                    aria-labelledby="eliminarTallerModalLabel<?php echo $fila['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eliminarTallerModalLabel<?php echo $fila['id']; ?>">
                                    Confirmar Eliminación
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>¿Estás seguro de que deseas eliminar el taller
                                    <strong><?php echo $fila['nombre']; ?></strong>?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <!-- Formulario para eliminar -->
                                <form action="../controllers/admin/talleres/eliminarTaller.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

                                    <button type="submit" name="eliminar" class="btn btn-danger">Eliminar</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>