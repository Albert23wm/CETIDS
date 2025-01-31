<!DOCTYPE html>
<html lang="es">
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="../assets/img/contenido/Icon.png">
  <title>Constancias</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Sweet Alert 2 -->
  <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="../node_modules/@fontsource/poppins/index.css">

  <!-- ICONOS -->
  <link href='../node_modules/boxicons/css/boxicons.min.css' rel='stylesheet'>

  <!-- ESTILOS -->
  <link rel="stylesheet" href="../assets/css/administrador/constancias.css">
</head>

<body>
  <?php
  session_start();

  include '../config/php/autenticacionAdministrador.php';
  include '../config/php/alertas.php';
  include '../config/php/conexion.php';
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
      <h5 class="text-white "><b id="title-header">CONSTANCIAS</b></h5>
    </div>

    <div class="col-6 col-md-3 text-end">
      <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
        style='color:#ffffff; font-size: 50px;'></i>

    </div>
  </header>

  <!--------------------------------------------------- Menú --------------------------------------------------->
  <?php include_once "../assets/partials/administrador/menu.php"; ?>

  <br><br><br><br><br><br><br><br><br>
  <div class="container marketing text-center">
    <div class="container marketing text-center">

      <!-- 
        <form method='post' action='enviar_email.php'>
            <button type='submit' name='enviar_todos_correos' class="btn">
                <i class='bx bx-mail-send'></i> Enviar todos los correos electrónicos
            </button>
        </form>
    -->

      <div class="btn-container">
        <form method="POST" action="../controllers/admin/constancias/filtrarConstancias.php">
          <button type="submit" name="enviada" class="btn btn-success">
            <i class='bx bx-check'></i> Filtrar constancias enviadas
          </button>
        </form>

        <form method="POST" action="../controllers/admin/constancias/filtrarConstancias.php">
          <button type="submit" name="sinEnviar" class="btn btn-danger">
            <i class='bx bx-x'></i> Filtrar constancias no enviadas
          </button>
        </form>

        <form method="POST" action="../controllers/admin/constancias/filtrarConstancias.php">
          <button type="submit" name="todos" class="btn btn-primary">
            <i class='bx bx-x'></i> Mostrar todo
          </button>
        </form>
      </div>
    </div>

    <table class="table table-striped table-bordered table-hover text-center">
      <thead class="thead-dark">
        <tr>
          <th>Matrícula</th>
          <th>Alumno</th>
          <th>Correo</th>
          <th>Taller</th>
          <th>Constancias</th>
          <th>Asistencia</th>
        </tr>
      </thead>

      <tbody>

        <?php

        if (!isset($_SESSION['filtro'])) {
          // Consulta sin filtro
          $query = "SELECT i.matricula, i.id_taller, CONCAT(e.nombre, ' ', e.apellido) AS nombreEstudiante, e.correo, t.nombre, i.asistencia, i.envio_constancia FROM inscripciones i
            INNER JOIN estudiantes e ON i.matricula = e.matricula
            INNER JOIN talleres t ON i.id_taller = t.id;
          ";
          $stmt = $conexion->prepare($query);

          if (!$stmt->execute()) {
            $_SESSION["error"] = "No se pudo obtener los datos de las constancias";
          }

        } else {
          // Filtro para la consultas
          $query = "SELECT i.matricula, i.id_taller, CONCAT(e.nombre, ' ', e.apellido) AS nombreEstudiante, e.correo, t.nombre, i.asistencia, i.envio_constancia FROM inscripciones i
            INNER JOIN estudiantes e ON i.matricula = e.matricula
            INNER JOIN talleres t ON i.id_taller = t.id
            WHERE i.asistencia = ?;
          ";

          $filtro = $_SESSION["filtro"];

          $stmt = $conexion->prepare($query);
          $stmt->bind_param("i", $filtro);

          if (!$stmt->execute()) {
            $_SESSION["error"] = "No se pudo obtener los datos de las constancias";
          }
        }

        $result = $stmt->get_result();

        $stmt->close();

        $filas = [];
        while ($fila = $result->fetch_assoc()) {
          $filas[] = $fila;
        }

        if ($result->num_rows > 0):
          foreach ($filas as $fila): ?>
            <tr>
              <td><?php echo $fila['matricula']; ?></td>
              <td><?php echo $fila['nombreEstudiante']; ?></td>
              <td><?php echo $fila['correo']; ?></td>
              <td><?php echo $fila['nombre']; ?></td>

              <?php if ($fila["asistencia"] == '0' || $fila["asistencia"] == NULL): ?>
                <td>No disponible</td>
                <td>X</td>
              <?php else: ?>
                <td>
                  <form action="../controllers/admin/constancias/generarConstancia.php" method="POST">
                    <input type="hidden" value="<?php echo $fila['matricula']; ?>" name="id">
                    <input type="submit" value="Generar constancia" name="Enviar"
                      style="text-decoration: underline; background-color: transparent; border: none; color: rgb(13 110 253);">
                  </form>
                </td>
                <td>✔</td>
              <?php endif; ?>

            <?php endforeach; ?>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>

</html>