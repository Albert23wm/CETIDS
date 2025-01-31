<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="../../assets/img/contenido/Icon.png">
  <title>Agregar taller</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- ALERT --><!-- Sweet Alert 2 -->
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
      <h5 class="text-white "><b>NUEVO TALLER</b></h5>
    </div>

    <div class="col-6 col-md-3 text-end">
      <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
        style='color:#ffffff; font-size: 50px;'></i>

    </div>
  </header>

  <!-- Menú -->
  <?php include_once '../../assets/partials/administrador/submenu.php'; ?>

  <br><br><br><br><br><br><br><br>

  <div class="container">
    <form action="../../controllers/admin/talleres/agregarTaller.php" method="POST" enctype="multipart/form-data">

      <div class="form-group">
        <label for="nombre_taller">Nombre del taller:</label>
        <input type="text" class="form-control" name="nombre" id="nombre" required>
      </div>

      <div class="form-group">
        <label for="descripcion">Descripción del taller:</label>
        <textarea class="form-control" name="descripcion" id="descripcion" required></textarea>
      </div>

      <div class="form-group">
        <label for="cupo">Cupo del taller:</label>
        <input type="number" class="form-control" name="cupo" id="cupo" required>
      </div>

      <div class="form-group">
        <label for="cuatri">¿Para que cuatrimestre va dirigido?</label>
        <input type="number" class="form-control" name="cuatrimestre" id="cuatrimestre" required>
      </div>

      <div class="form-group">
        <label for="ponente">Tallerista:</label>
        <select class="form-select" name="ponente">
          <?php

          $sql = "SELECT id, CONCAT(nombre, ' ', apellido) AS nombreCompleto FROM ponentes";
          //$sql = "SELECT id_ponente, CONCAT(nombre_ponente, ' ', apellido_ponente) AS nombre_completo FROM ponentes WHERE rol = 'Tallerista' OR rol = 'Egresado' OR rol= 'Tallerista Externo'";
          $result = $conexion->query($sql);

          if ($result->num_rows > 0) {
            // Generar opciones basadas en los resultados de la consulta
            while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row["id"] . '">' . $row["nombreCompleto"] . '</option>';
            }
          }

          // Cerrar la conexión a la base de datos
          $conexion->close();
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="imagenTaller">Imagen del taller:</label>
        <input type="file" class="form-control" name="imagenTaller" id="imagenTaller" accept="image/*" required>
      </div>

      <br>

      <button type="submit" name="submit" class="btn btn-danger">Agregar</button>
    </form>

    <div class="col-md-6">
      <div class="showQRCode"></div>
    </div>

    <div class="insert-post-ads1" style="margin-top:20px;">

    </div>
  </div>


</body>

</html>