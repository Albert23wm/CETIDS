<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Asistencia</title>

  <!-- Poppins -->
  <link rel="stylesheet" href="../../node_modules/@fontsource/poppins/index.css">

  <!-- Sweet Alert 2 -->
  <script src="../../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.min.css">

  <!-- ICONOS -->
  <link href="../../node_modules/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../../assets/img/contenido/Icon.png">

  <script src="https://unpkg.com/html5-qrcode"></script>

  <link rel="stylesheet" href="../../assets/css/estudiante/registrarAsistencia.css">
</head>

<body>
  <?php
  session_start();
  include '../../config/php/autenticacionEstudiante.php';
  include '../../config/php/conexion.php';
  include '../../config/php/alertas.php';
  ?>

  <header
    class="d-flex flex-wrap align-items-center justify-content-between py-2 py-md-4 mb-4 border-bottom fixed-top container-fluid"
    style="background: linear-gradient(to bottom,#611232, #611232,#611232); margin-bottom: 0;">
    <div class="col-6 col-md-3 mb-2 mb-md-0">
      <a href="" class="d-inline-flex link-body-emphasis text-decoration-none">
        <img src="../../assets/img/contenido/LogoUTVM.png" width="150" alt="Logo">
      </a>
    </div>
    <div class="col-12 col-md-6 mb-2 text-center mb-md-0">
      <h5 class="text-white"><b>ASISTENCIA</b></h5>
    </div>
    <div class="col-6 col-md-3 text-end">
      <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
        style='color:#ffffff; font-size: 50px;'></i>
    </div>
  </header>

  <?php include_once '../../assets/partials/estudiante/submenu.php'; ?>

  <br><br><br><br><br><br>

  <main>
    <div class="container container-fluid">
      <div class="row md-6 text-center">
        <h1 style="text-align: center;"><b>Escanea el QR de tu taller</b></h1>
        <div class="lector-qr" id="qr-reader" style="width:500px; margin: 0 auto;"></div>
        <div class="qr-results" id="qr-reader-results" style="margin-top: 20px; font-size: 18px; text-align: center;"></div>
      </div>
    </div>
  </main>

  <script>
    let lastResult = "";

    // Función que se ejecuta cuando se escanea un QR exitosamente
    function onScanSuccess(decodedText, decodedResult) {
      if (decodedText !== lastResult) { // Evita procesar el mismo código varias veces
        lastResult = decodedText;

        // Mostrar el texto escaneado en el contenedor
        const resultsContainer = document.getElementById("qr-reader-results");
        resultsContainer.innerHTML = `
            <a style="width: 100%;" href="${decodedText}"><button class="btn btn-success" style="width: 100%; height: 100%;">Registrar asistencia</button></a>
        `;
      }
    }

    // Inicializar el escáner QR
    const html5QrcodeScanner = new Html5QrcodeScanner(
      "qr-reader", { fps: 10, qrbox: 250 }
    );

    // Pasar la función de éxito al escáner
    html5QrcodeScanner.render(onScanSuccess);
  </script>
</body>

</html>