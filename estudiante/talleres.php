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

    <!-- Poppins -->
    <link rel="stylesheet" href="../node_modules/@fontsource/poppins/index.css">

    <!-- Sweet Alert 2 --><!-- Sweet Alert 2 -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">

    <!-- ICONOS -->
    <link href="../node_modules/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/img/contenido/Icon.png">

    <!-- ESTILOS -->
    <link rel="stylesheet" href="../assets/css/estudiante/talleres.css">

</head>

<body>
    <?php
    session_start();

    include '../config/php/autenticacionEstudiante.php';
    include '../config/php/conexion.php';
    include '../config/php/alertas.php';

    $matricula = $_SESSION['idEstudiante'];

    $query = "SELECT nombre, grado FROM estudiantes WHERE matricula = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $matricula);

    if ($stmt->execute()) {
        $resultado = $stmt->get_result();

        $filas = $resultado->fetch_assoc();

        // Guardar datos del estudiante
        $nombre = $filas["nombre"];
        $grado = $filas["grado"];

    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);

    }
    $stmt->close();
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

            <h5 class="text-white "><b>TALLERES</b></h5>

        </div>

        <div class="col-6 col-md-3 text-end">

            <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
                style='color:#ffffff; font-size: 50px;'>
            </i>
        </div>
    </header>

    <?php include "../assets/partials/estudiante/menu.php"; ?>

    <br><br><br><br><br><br>

    <main>

        <div class="container">
            <div class="row">
                <div class="container marketing text-center">
                    <div class="row justify-content-center">
                        <i class='bx bxs-user-circle' style='color:#00A651; font-size:90px;'></i>

                        <h3 name="estudiante"><b>Bienvenid@
                                <?php echo $nombre; ?>
                            </b></h3>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">

                            <strong>¡ATENCIÓN!</strong><br> Por favor, ten en cuenta que la inscripción está limitada a
                            solo <b>UN</b> curso por persona.<br> Una vez que te hayas inscrito, dirigete al menú y ve
                            al apartado <b>"Mis talleres"</b> para registrar tu asistencia.

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>

                        <br><br><br>

                        <?php
                        // Comprobación de inscripción existente                        
                        $query = "SELECT * FROM inscripciones WHERE matricula = ?";
                        $stmt = $conexion->prepare($query);

                        $stmt->bind_param("i", $matricula);

                        if (!$stmt->execute()) {
                            $_SESSION["error"] = "Hubo un error al valida información";
                        }

                        $resultado = $stmt->get_result();

                        if ($resultado->num_rows > 0):
                            $_SESSION['success'] = '¡Ya estás inscrito a un taller!';
                            echo '<h5>¡Ya estás inscrito a un taller!</h5>';

                        else:
                            $resultado->close();

                            $query = "SELECT t.*, CONCAT(p.nombre, ' ', p.apellido) AS nombrePonente 
                                FROM talleres t
                                INNER JOIN ponentes p ON t.id_ponente = p.id WHERE t.cupo > 0 AND t.cuatrimestre = ?;
                            ";

                            $stmt = $conexion->prepare($query);
                            $stmt->bind_param("i", $grado);

                            if (!$stmt->execute()) {
                                $_SESSION["error"] = "Hubo un error al consultar los datos de los talleres";
                            }

                            $resultado = $stmt->get_result();

                            if ($resultado->num_rows == 0):
                                $_SESSION["warning"] = "No hay talleres disponibles";

                            else:
                                // Guardar los datos del taller en un array
                                $filas = [];
                                while ($fila = $resultado->fetch_assoc()) {
                                    $filas[] = $fila;
                                }

                                $resultado->close();
                                ?>
                                <div class="container">
                                    <div class="row">
                                        <?php foreach ($filas as $fila): ?>
                                            <div class="col-md-4 col-sm-6 mb-4">
                                                <div class="card"
                                                    style="width: 100%; background: linear-gradient(45deg, rgba(0, 0, 0, 0.514) 0%, rgba(0, 0, 0, 0.596) 100%), url(../<?php echo $fila['ruta_imagen']; ?>); background-size: cover;">

                                                    <div class="card-img-bg" style="filter: grayscale(100%);"></div>
                                                    <div class="card-body">
                                                        <h3 class="card-title text-white"><b>
                                                                <?php echo $fila['nombre']; ?>
                                                            </b></h3>

                                                        <p class="card-text text-white text-capitalize">Ponente:
                                                            <?php echo $fila['nombrePonente']; ?>
                                                        </p>

                                                        <p class="card-text text-white">Cupo:
                                                            <?php echo $fila['cupo']; ?>
                                                        </p>

                                                        <form method="POST" action="../controllers/estudiantes/registraTaller.php">
                                                            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                                                            <button type="submit" class="btn text-white" name="inscribirse"
                                                                style="background: #F44141;">Inscribirse</button>
                                                        </form>

                                                        <button type="button" class="btn text-white mt-2"
                                                            style="border-color: #ffffff;" data-bs-toggle="modal"
                                                            data-bs-target="#proyectoModal<?php echo $fila['id']; ?>">
                                                            Ver detalles
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="proyectoModal<?php echo $fila['id']; ?>"
                                                            tabindex="-1"
                                                            aria-labelledby="proyectoModalLabel<?php echo $fila['id']; ?>"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="proyectoModalLabel<?php echo $fila['id']; ?>">
                                                                            Detalles del
                                                                            taller</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h2 style="color:#A12043">
                                                                            <b><?php echo $fila['nombre']; ?></b>
                                                                        </h2>
                                                                        <p><b style="color:#008735">Descripción del curso:</b>
                                                                            <br><?php echo $fila['descripcion']; ?>
                                                                        </p>
                                                                        <p><b style="color:#008735">Cupos disponibles:</b>
                                                                            <span
                                                                                style="color:#A12043"><?php echo $fila['cupo']; ?></span>
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Fin del modal -->
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            <?php endif; endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>



</body>

</html>