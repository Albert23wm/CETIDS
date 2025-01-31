<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <title>Convocatorias</title>
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
    style="background: linear-gradient(to bottom, #611232, #611232,#611232); margin-bottom: 0;">

    <div class="col-6 col-md-3 mb-2 mb-md-0 ">
      <a class="d-inline-flex link-body-emphasis text-decoration-none">
        <img src="../assets/img/contenido/LogoUTVM.png" width="150" alt="Logo">
      </a>
    </div>
    <div class="col-12 col-md-6 mb-2 text-center mb-md-0">
      <h5 class="text-white "><b>CONVOCATORIAS</b></h5>
    </div>

    <div class="col-6 col-md-3 text-end">
      <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
        style='color:#ffffff; font-size: 50px;'></i>

    </div>
  </header>

  <?php include_once '../assets/partials/administrador/menu.php'; ?>

  <br><br><br><br><br><br>

  <div class="container marketing text-center">
    <a href="convocatorias/nuevaConvocatoria.php" style="text-align: right;">
      <img src="../assets/img/contenido/añadir.png" width="8%">
    </a>
    <h5 class="text-center" style="color:#611232;"><b>Nueva Convocatoria</b></h5>
    <br>
    <?php
    // Conexión a la base de datos
    include("../config/php/conexion.php");

    // Consulta SQL para obtener las convocatorias
    $consulta = "SELECT * FROM convocatorias";
    $resultado = mysqli_query($conexion, $consulta);

    // Almacenar las filas en un array
    $filas = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
      $filas[] = $fila;
    }
    ?>
    <?php if ($resultado->num_rows > 0): ?>
      <table class="table table-striped table-bordered table-center text-center">
        <thead class="thead-dark">
          <tr>
            <th>Nombre</th>
            <th>Archivo</th>
            <th>Tipo de convocatoria</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($filas as $fila): ?>
            <tr>
              <td><?php echo $fila['nombre']; ?></td>

              <td>
                <a class="" data-toggle="modal" data-target="#mostrarArchivoModal<?php echo $fila['id']; ?>">
                  <?php echo $fila['nombre_documento']; ?>
                </a>
              </td>

              <td><?php echo $fila['categoria']; ?></td>

              <td>
                <a data-toggle="modal" data-target="#eliminarConvocatoriaModal<?php echo $fila['id']; ?>">
                  <i class="bx bx-trash" style="color:#ff0202; font-size:30px;"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>

          <?php foreach ($filas as $fila): ?>
            <div class="modal" id="mostrarArchivoModal<?php echo $fila['id']; ?>" tabindex="-1" role="dialog"
              aria-labelledby="mostrarArchivoModalLabel<?php echo $fila['id']; ?>" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="mostrarArchivoModalLabel<?php echo $fila['id']; ?>">
                      <?php echo $fila['nombre']; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <embed type="application/pdf" src="../<?php echo $fila['ruta_documento']; ?>" width="100%"
                      height="600px" />
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

          <?php foreach ($filas as $fila): ?>
            <div class="modal fade" id="eliminarConvocatoriaModal<?php echo $fila['id']; ?>" tabindex="-1" role="dialog"
              aria-labelledby="eliminarConvocatoriaLabel<?php echo $fila['id']; ?>" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="eliminarConvocatoriaLabel<?php echo $fila['id']; ?>">
                      Confirmar Eliminación
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar la convocatoria
                      <strong><?php echo $fila['nombre']; ?></strong>?
                    </p>
                  </div>
                  <div class="modal-footer">
                    <form action="../controllers/admin/convocatoria/eliminarConvocatoria.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" name="Eliminar" class="btn btn-danger">Eliminar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No se han publicado convocatorias</p>
    <?php endif; ?>
  </div>

  <!-- Incluye la biblioteca jQuery y Popper.js (necesarios para el funcionamiento de Bootstrap) -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <!-- Incluye la biblioteca Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>