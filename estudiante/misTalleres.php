<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Mis talleres</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Poppins -->
    <link rel="stylesheet" href="../node_modules/@fontsource/poppins/index.css">

    <!-- Sweet Alert 2 --><!-- Sweet Alert 2 -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">

    <!-- ICONOS -->
    <link href="../node_modules/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/img/contenido/Icon.png">

    <!-- ESTILOS -->
    <link rel="stylesheet" href="../assets/css/estudiante/misTalleres.css">
</head>

<body>
    <?php
    session_start();

    include '../config/php/autenticacionEstudiante.php';
    include '../config/php/conexion.php';
    include '../config/php/alertas.php';

    $matricula = $_SESSION['idEstudiante'];

    $query = "SELECT t.id AS idTaller, t.nombre AS nombreTaller, i.id AS idInscripcion, t.ruta_imagen AS tallerImagen
        FROM inscripciones i
        INNER JOIN talleres t ON t.id = i.id_taller
        WHERE i.matricula = ?;
    ";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $matricula);

    if (!$stmt->execute()) {
        $_SESSION['error'] = 'Hubo un error al consultar los datos de la inscripcion';
    }

    $resultado = $stmt->get_result();

    $filas = [];
    while ($fila = $resultado->fetch_assoc()) {
        $filas[] = $fila;
    }

    $stmt->close();
    ?>

    <header
        class="d-flex flex-wrap align-items-center justify-content-between py-2 py-md-4 mb-4 border-bottom fixed-top container-fluid"
        style="background: linear-gradient(to bottom, #611232, #611232,#611232); margin-bottom: 0;">

        <div class="col-6 col-md-3 mb-2 mb-md-0 ">

            <a class="d-inline-flex link-body-emphasis text-decoration-none">

                <img src="../assets/img/contenido/LogoUTVM.png" width="150" alt="Logo">

            </a>

        </div>

        <div class="col-12 col-md-6 mb-2 text-center mb-md-0">

            <h5 class="text-white "><b>MIS TALLERES</b></h5>

        </div>

        <div class="col-6 col-md-3 text-end">

            <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
                style='color:#ffffff; font-size: 50px;'>
            </i>
        </div>
    </header>

    <?php include_once "../assets/partials/estudiante/menu.php" ?>

    <br><br><br><br><br><br>

    <main>
        <div class="container">
            <div class="row">
                <div class="container marketing text-center">
                    <div class="row justify-content-center">
                        <h1>Talleres inscritos: </h1>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Por favor, asegúrate de verificar cuidadosamente que te proporcionen el QR correcto
                            correspondiente <br>al taller que estás asistiendo. Esto es necesario para registrar tu
                            asistencia correctamente.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <?php
                        if ($resultado->num_rows > 0): ?>
                            <?php foreach ($filas as $fila): ?>
                                <div class="card"
                                    style="width: 18rem; margin-right: 20px; margin-bottom: 20px; background: linear-gradient(45deg, rgba(0, 0, 0, 0.514) 0%, rgba(0, 0, 0, 0.596) 100%), url('../<?php echo $fila['tallerImagen']; ?>'); background-size: cover;">
                                    <div class="card-img-bg" style="filter: grayscale(100%);"></div>
                                    <div class="card-body">
                                        <br><br><br>
                                        <h5 class="card-title text-white">Taller:
                                            <br><b><?php echo $fila['nombreTaller']; ?></b>
                                        </h5>
                                        <br><br><br><a href="talleres/registrarAsistencia.php" class="btn text-white"
                                            style="border-color: #ffffff;">Registrar asistencia</a>
                                        <br><br><br>
                                        <button type="button" class="btn text-white" style="border-color: #ffffff;"
                                            data-bs-toggle="modal"
                                            data-bs-target="#cancelarInscripcionModal<?php echo $fila['idTaller']; ?>">
                                            Cancelar suscripción
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else:
                            $_SESSION['warning'] = "Aun no estás registrado a un taller";
                        endif; ?>
                        <!-- Fin del código para mostrar los talleres inscritos -->

                        <!-- Resto de tu código -->
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($filas as $fila): ?>
            <!-- Modal para cancelar inscripción -->
            <div class="modal fade" id="cancelarInscripcionModal<?php echo $fila['idTaller']; ?>" tabindex="-1"
                role="dialog" aria-labelledby="cancelarInscripcionLabel<?php echo $fila['idTaller']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancelarInscripcionLabel<?php echo $fila['idTaller']; ?>">
                                Confirmar Cancelación de Inscripción
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas cancelar tu inscripción al taller
                                <strong><?php echo $fila['nombreTaller']; ?></strong>?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <!-- Formulario para cancelar inscripción -->
                            <form action="../controllers/estudiantes/eliminarInscripcion.php" method="POST">
                                <input type="hidden" name="idInscripcion" value="<?php echo $fila['idInscripcion']; ?>">
                                <input type="hidden" name="idTaller" value="<?php echo $fila['idTaller']; ?>">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, mantener
                                    inscripción</button>
                                <button type="submit" name="eliminar" class="btn btn-danger">Sí, cancelar
                                    inscripción</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <script>
            // El código JavaScript para escanear el código QR y manejar la lógica de sesión
            const matricula = "<?php echo isset($_SESSION['matricula']) ? $_SESSION['matricula'] : ''; ?>";
            // Usa 'matricula' donde necesites la matrícula en tu lógica JavaScript
        </script>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>