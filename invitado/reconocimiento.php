<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <title>Reconocimiento</title>

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
  <link rel="stylesheet" href="../assets/css/estudiante/reconocimiento.css">

</head>

<body>

  <?php

  session_start();

  include '../config/php/autenticadorInvitado.php';
  include '../config/php/conexion.php';
  include '../config/php/alertas.php';

  $idInvitado = $_SESSION['idInvitado'];

  $query = "SELECT nombre FROM invitados WHERE id = ?";

  $stmt = $conexion->prepare($query);
  $stmt->bind_param("i", $idInvitado);

  if (!$stmt->execute()) {
    $_SESSION['error'] = 'Hubo un error al consultar los datos de la inscripcion';
  }

  $resultado = $stmt->get_result();

  $fila = $resultado->fetch_assoc();

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

      <h5 class="text-white "><b>RECONOCIMIENTO</b></h5>

    </div>

    <div class="col-6 col-md-3 text-end">

      <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
        style='color:#ffffff; font-size: 50px;'>
      </i>
    </div>
  </header>

  <?php include_once "../assets/partials/invitados/menu.php"; ?>

  <br><br><br><br><br><br>

  <main>

    <div class="container">
      <div class="row">
        <div class="container marketing text-center">
          <div class="row justify-content-center">
            <i class='bx bxs-user-circle' style='color:pink; font-size:90px;'></i>

            <h3 name="estudiante"><b>Bienvenid@ <?php echo $fila['nombre']; ?></b>

            </h3>
            <div class="alert alert-success alert-dismissible fade show" role="alert">

              <h5><b>¡GRACIAS POR ASISTIR AL CONGRESO ESTATAL DE TECNOLOGÍAS DE LA INFORMACIÓN, ÁREA EN DESARROLLO Y
                  GESTIÓN DE SOFTWARE 2024!</b></h5><br> En este apartado se reflejará tu reconocimiento por tu
              asistencia en este evento.

              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>

            <div class="card"
              style="width: 18rem; background-image: url('../assets/img/contenido/ReconocimientoFondo.png'); background-size: cover;">

              <div class="card-body">

                <br><br><br><br><br><br>
                <!-- Botón para generar PDF -->

                <form action="../controllers/invitado/generarReconocimiento.php" method="POST">
                  <input type="hidden" name="id" value="<?php echo $idInvitado; ?>">
                  <button type="submit" class="btn" style="background:#3CAA37; color:white;" name="generar">Generar
                    reconocimiento</button>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</body>

</html>