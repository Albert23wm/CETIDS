<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Agregar actividad</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ICONOS -->
    <link href='../../node_modules/boxicons/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../../assets/img/contenido/Icon.png" type="image/x-icon">

    <!-- Sweet Alert 2 --><!-- Sweet Alert 2 -->
    <script src="../../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.min.css">

</head>

<body>
    <?php
    session_start();

    include '../../config/php/autenticacionAdministrador.php';
    include '../../config/php/alertas.php';
    include '../../config/php/conexion.php';
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
            <h5 class="text-white "><b>AGREGAR ACTIVIDAD</b></h5>
        </div>

        <div class="col-6 col-md-3 text-end">
            <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
                style='color:#ffffff; font-size: 50px;'></i>

        </div>
    </header>

    <?php include_once '../../assets/partials/administrador/submenu.php'; ?>

    <br><br><br><br><br><br><br><br>

    <?php
    // Obtener los datos de los ponentes
    $query = "SELECT id, CONCAT(nombre, ' ', apellido) AS nombreCompleto FROM ponentes";

    $result = mysqli_query($conexion, $query);

    ?>

    <div class="container">
        <form method="POST" action="../../controllers/admin/actividades/nuevaActividad.php"
            enctype="multipart/form-data">
            <section id="8" class="content">
                <div class="form-container">
                    <form method="post" action="" class="activity-form">
                        <div class="mb-3">
                            <label for="dia-act" class="form-label">Día</label>
                            <select class="form-select" name="dia" id="dia" required>
                                <option value="" selected disabled>Elige un día</option>
                                <option value="1">Día 1</option>
                                <option value="2">Día 2</option>
                                <option value="3">Día 3</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nameAct" class="form-label">Nombre de la actividad</label>
                            <input type="text" name="nombre" id="nombre" class="form-control"
                                placeholder="Nombre de la actividad" required>
                        </div>

                        <div class="mb-3">
                            <label for="asist" class="form-label">Asistentes</label>
                            <input type="number" name="cuatrimestre" id="cuatrimestre" class="form-control"
                                placeholder="Asistentes, ej: 1 y 4" required>
                        </div>

                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="horaAct" class="form-label">Hora de la actividad</label>
                            <input type="text" name="hora" id="hora" class="form-control"
                                placeholder="Hora de la actividad, ej: 9:00 hrs." required>
                        </div>

                        <div class="mb-3">
                            <label for="lugarAct" class="form-label">Lugar de la actividad</label>
                            <input type="text" name="lugar" id="lugar" class="form-control"
                                placeholder="Lugar de la actividad" required>
                        </div>

                        <div class="mb-3">
                            <label for="PonCord" class="form-label">Ponente</label>
                            <select class="form-select" name="ponente" id="ponente" required>
                                <option value="" selected disabled>Elige al participante</option>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "' name='ponente'>" . $row['nombreCompleto'] . "</option>";
                                    }
                                } else {
                                    echo "<p>No hay participantes en el sistema</p>";
                                }
                                ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-danger">Guardar Actividad</button>

                        <br><br><br>
                    </form>
                </div>
            </section>
        </form>

    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>