<?php
session_start();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];

// Consulta para obtener la información del estudiante
$consulta = "SELECT CONCAT(e.nombre, ' ', e.apellido) AS nombreCompleto, t.nombre, e.matricula, i.id AS idInscripcion
        FROM inscripciones i
        INNER JOIN estudiantes e ON i.matricula = e.matricula
        INNER JOIN talleres t ON i.id_taller = t.id
        WHERE e.matricula = ?;
    ";

$stmt = $conexion->prepare($consulta);
$stmt->bind_param('i', $id);

if (!$stmt->execute()) {
    $_SESSION['error'] = 'No se pudo obtener la información del usuario';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$result = $stmt->get_result();

$stmt->close();

if ($result->num_rows == 0) {
    $_SESSION['error'] = 'No se pudo obtener la información del usuario';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$fila = $result->fetch_assoc();
?>
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
    <header
        class="d-flex flex-wrap align-items-center justify-content-between py-2 py-md-4 mb-4 border-bottom fixed-top container-fluid"
        style="background: linear-gradient(to bottom, #0E773F, #008735,#035223); margin-bottom: 0;">

        <div class="col-6 col-md-3 mb-2 mb-md-0 ">
            <a class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="../assets/img/contenido/LogoUTVM.png" width="150" alt="Logo">
            </a>
        </div>
        <div class="col-12 col-md-6 mb-2 text-center mb-md-0">
            <h5 class="text-white "><b id="title-header">FELICIDADES</b></h5>
        </div>

        <div class="col-6 col-md-3 text-end">
            <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
                style='color:#ffffff; font-size: 50px;'></i>

        </div>
    </header>

    <?php include 'assets/partials/principal/menu.php'; ?>

    <main>
        <div>
            <h1><?php echo $fila['nombreCompleto']; ?></h1> <br>
            <h1><?php echo $fila['nombre']; ?></h1> <br>
        </div>
    </main>

</body>

</html>