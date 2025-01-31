<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <title>Actividades</title>
  <link rel="icon" type="image/png" href="../assets/img/contenido/Icon.png">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- ALERT -->
  <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="../node_modules/@fontsource/poppins/index.css">

  <!-- ICONOS -->
  <link href='../node_modules/boxicons/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <?php
  session_start();

  include '../config/php/alertas.php';
  include '../config/php/autenticacionAdministrador.php';  
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
      <h5 class="text-white "><b>ACTIVIDADES</b></h5>
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
    <a href="actividades/nuevaActividad.php" style="text-align: right;">
      <img src="../assets/img/contenido/añadir.png" width="8%">
    </a>
    <h5 class="text-center" style="color:#611232;"><b>Nueva Actividad</b></h5>
    <br>
    <?php
    // Conexión a la base de datos
    include("../config/php/conexion.php");

    // Consulta SQL para obtener los ponentes
    $consulta = "SELECT * FROM actividades";
    $resultado = mysqli_query($conexion, $consulta);

    // Convertir a arreglo
    $filas = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
      $filas[] = $fila;
    }

    if ($resultado->num_rows > 0): ?>
      <table class="table table-striped table-bordered table-center text-center">
        <thead class="thead-dark">
          <tr>
            <th>Día</th>
            <th>Nombre Actividad</th>
            <th>Asistentes</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Lugar</th>
            <th>Ponente</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($filas as $fila):
            $ponenteId = $fila['id_ponente'];

            $consulta = "SELECT CONCAT(nombre, ' ', apellido) AS nombreCompleto FROM ponentes WHERE id = $ponenteId";
            $resultados = mysqli_query($conexion, $consulta);

            $resultadoConsulta = $resultados->fetch_assoc();
            $nombrePonente = $resultadoConsulta["nombreCompleto"]; ?>

            <tr>
              <td><?php echo $fila['dia']; ?></td>
              <td><?php echo $fila['nombre']; ?></td>
              <td><?php echo $fila['asistentes']; ?></td>
              <td><?php echo $fila['fecha']; ?></td>
              <td><?php echo $fila['hora']; ?></td>
              <td><?php echo $fila['ubicacion']; ?></td>
              <td><?php echo $nombrePonente ?></td>
              <td>
                <a data-bs-toggle="modal" data-bs-target="#editarActividadModal<?php echo $fila['id']; ?>">
                  <i class="bx bx-edit" style="color:#ba6057; font-size: 50px;"></i>
                </a>
                <a data-bs-toggle="modal" data-bs-target="#eliminarActividadModal<?php echo $fila['id']; ?>">
                  <i class="bx bxs-trash" style="font-size: 50px; color:#FFBDB7;"></i> 
                </a>
              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>

      <?php foreach ($filas as $fila): ?>
        <!-- Modal para Editar Taller -->
        <div class="modal fade" id="editarActividadModal<?php echo $fila['id']; ?>" tabindex="-1" role="dialog"
          aria-labelledby="editarActividadModalLabel<?php echo $fila['id']; ?>" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editarActividadModalLabel<?php echo $fila['id']; ?>">
                  Editar actividad: <?php echo $fila['nombre']; ?>
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="../controllers/admin/actividades/editarActividad.php" method="POST"
                  enctype="multipart/form-data">
                  <?php include 'actividades/editarActividad.php'; ?>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal para Eliminar Taller -->
        <div class="modal fade" id="eliminarActividadModal<?php echo $fila['id']; ?>" tabindex="-1" role="dialog"
          aria-labelledby="eliminarActividadModalLabel<?php echo $fila['id']; ?>" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="eliminarActividadModalLabel<?php echo $fila['id']; ?>">
                  Confirmar Eliminación
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar la actividad
                  <strong><?php echo $fila['nombre']; ?></strong>?
                </p>
              </div>
              <div class="modal-footer">
                <!-- Formulario para eliminar -->
                <form action="../controllers/admin/actividades/eliminarActividad.php" method="POST">
                  <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                  <button type="submit" name="eliminar" class="btn btn-danger">Eliminar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

      <?php
      // Cerrar la conexión a la base de datos
      $conexion->close(); ?>


    <?php else: ?>
      <p>No hay actividades en el sistema por el momento</p>
    <?php endif; ?>
  </div>

</body>

</html>