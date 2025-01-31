<!doctype html>
<html lang="es" data-bs-theme="auto">

<head>
  <script src="../assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" href="assets/img/contenido/Icon.png">
  <title>Congreso Estatal 2024· UTVM</title>

  <!-- BOOSTRAP -->
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="node_modules/@fontsource/poppins/index.css">
  <link href="node_modules/boxicons/css/boxicons.min.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/carousel.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="assets/css/index.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php
  session_start();

  include 'config/php/conexion.php';
  ?>
  <script>
    //
    function openModal(modalId) {
      document.getElementById(modalId).style.display = "flex";
    }
    function closeModal(modalId) {
      document.getElementById(modalId).style.display = "none";
    }
    // Cerrar el modal haciendo clic fuera de él
    window.onclick = function (event) {
      if (event.target.className === 'modal') {
        event.target.style.display = "none";
      }
    }
  </script>


  <script>

    //pdf-conv
    $(document).ready(function () {
      $('.open-pdf-modal').click(function () {
        var pdfSrc = $(this).data('pdf-src');
        $('#pdfContainer').attr('src', pdfSrc);
        $('#Modal-programa').show();
      });
      $('#close-pro').click(function () {
        $('#Modal-programa').hide();
      });
    });

    //modal convocatoria 
    var openModalBtns = document.getElementsByClassName('openModalBtnPro');
    var closeModalBtn = document.getElementById('close-pro');
    var modal = document.getElementById('Modal-programa');

    for (var i = 0; i < openModalBtns.length; i++) {
      openModalBtns[i].onclick = function () {
        modal.style.display = 'block';
      };
    }

    closeModalBtn.onclick = function () {
      modal.style.display = 'none';
    };

    window.onclick = function (event) {
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    };
    // Obtén elementos del DOM pdf-C
    const openPdfButtonC = document.getElementById('open-pdf-c');
    const pdfModalC = document.getElementById('pdf-modal-c');
    const pdfIframeC = document.getElementById('pdf-iframe-c');

    // Agrega un evento click al enlace para abrir el modal
    openPdfButtonC.addEventListener('click', () => {
      pdfModalC.style.display = 'block';
    });

    // Agrega un evento click para cerrar el modal al hacer clic fuera del contenido
    pdfModalC.addEventListener('click', (event) => {
      if (event.target === pdfModalC) {
        pdfModalC.style.display = 'none';
      }
    })

    // Obtén elementos del DOM pdf-C
    const openButton = document.getElementById('open-modal');
    const ModalAct = document.getElementById('act-modal');

    // Agrega un evento click al enlace para abrir el modal
    openPButton.addEventListener('click', () => { });

    // Agrega un evento click para cerrar el modal al hacer clic fuera del contenido
    pdfModalC.addEventListener('click', (event) => {
      if (event.target === pdfModalC) {
        pdfModalC.style.display = 'none';
      }
    })
    //modal-ac
  </script>

  <script>
    function openContent(evt, contentName) {
      var i, x, tablinks;
      x = document.getElementsByClassName("content");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablink");
      for (i = 0; i < x.length; i++) {
        tablinks[i].classList.remove("tablink-active"); // Elimina la clase de la pestaña activa actual
      }
      document.getElementById(contentName).style.display = "block";
      evt.currentTarget.firstElementChild.classList.add("tablink-active"); // Agrega la clase a la pestaña activa
    }

    // Abre por defecto la sección 1 y la activa
    document.addEventListener("DOMContentLoaded", function () {
      openContent({ currentTarget: { firstElementChild: document.querySelector(".tablink:nth-child(1)") } }, "1");
    });
  </script>

  <div class="container-fluid">

    <div class="row" style="background:#611232;">

      <div class="col-md-12 col-lg-12">
        <div class="col-md-6 col-lg-6 titulo_seph" style="background:#611232;">
          <p style="padding-top: 4%">
            <a href="http://www.utvm.edu.mx" class="hidden-m"
              style="text-decoration: none; color: #FFF; font-family: 'Graphik-Bold', Tahoma, Verdana !important; font-weight: bolder; font-size: 16px;">
              <b>SEPH | Universidad Tecnológica del Valle del Mezquital</b>
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <img src="assets/img/contenido/Banner.jpg" id="logo" width="100%">

  <script>
    $(".submenu").click(function () {
      $(this).children("ul").slideToggle();
    })

    $("ul").click(function (ev) {
      ev.stopPropagation();
    })
  </script>

  <!--------------------------------------------------- Header --------------------------------------------------->
  <header>
      <input type="checkbox" id="btn-menu"/>
          <label for="btn-menu">
                <i class='bx bx-menu' style='color:#fffbfb; font-size:50px; '  ></i>
          </label>
    <nav class="nav menu">
          
        <div class="container-fluid">
             
            <div class="row">
              <ul class="nav" style="margin-bottom: 0;">
                <li class="nav-item"><a href="#Actividades" onclick="cerrar()" class="nav-link text-white" style="margin-right: 20px;">Actividades</a></li>
                <li class="nav-item"><a href="#Convocatorias" onclick="cerrar()" class="nav-link text-white" style="margin-right: 20px;" >Convocatorias</a></li>
    
    
                <li class="hide-on-mobile">
                    <a class="navbar-brand">
                        <img id="iso-img" src="assets/img/contenido/ut.png" alt="Logo" width="155" height="130" class="d-inline-block align-text-top">

                    </a>
                </li>
                <li class="hide-on-mobile"><a href="#"id="iso-img" class="nav-link text-white" style="margin-right: 50px;">&nbsp;</a></li>
    
                <li class="nav-item"><a href="#Participantes" class="nav-link text-white" onclick="cerrar()" style="margin-right: 20px;">Participantes</a></li>
                <li class="nav-item">
                  <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" onclick="cerrar()">
                    Más
                  </a>
                  <div class="dropdown-menu" style="background: linear-gradient(to bottom, #611232, #a04e62);"><!--CAMBIO DE COLOR EN EL SUB MENU -SHOWI -->
                    <a class="dropdown-item" class="btn btn-primary" data-toggle="modal" data-target="#myModal">¿Cómo llegar?</a>
                    <a class="dropdown-item" href="#Patrocinadores">Patrocinadores</a>
                    <a class="dropdown-item" href="#Contacto">Contacto</a>
                  </div>
                </li>
                
              </ul>
            </div>
        </div>
    </nav>
    </header>
    

  <!--------------------------------------------------- Carrusel --------------------------------------------------->
  <div id="myCarousel" class="carousel slide mb-6 carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
        aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="6" aria-label="Slide 7"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="7" aria-label="Slide 8"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/img/carousel/EdificioD.jpg" class="d-block w-100 img-fluid c-img" alt="Slide 1">

        <div class="container">
          <div class="carousel-caption">
            <div class="banner">
              <div class="container">

                <div class="row">
                  <div class="col-sm-5">
                    <h1><strong>¡Las tecnologías disruptivas en un mundo globalizado!</strong></h1><br>
                    <a class="btn btn-lg btn_favorite align-items-center" href="cong/login.php"
                      style="background: linear-gradient(to bottom,#611232, #611232,#611232);">INICIAR SESIÓN</a>
                  </div>
                  <div class="col-sm-7">
                  <img src="assets/img/carousel/log2.png" class="d-block w-100 c-img" alt="Slide 3">
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="carousel-item">
        <img src="assets/img/carousel/Conferencia.jpg" class="d-block w-100 c-img" alt="Slide 3">
        <div class="container">
          <div class="carousel-caption">
            <div class="banner">
              <div class="container">
                <div class="col-sm">
                  <h1><strong>CONFERENCIAS</strong></h1><br>

                  <p>"Conferencias magistrales que iluminarán tu mente."</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="carousel-item">
        <img src="assets/img/carousel/Talleres.jpg" loop class="d-block w-100 c-img" alt="Slide 3">
        <div class="container">
          <div class="carousel-caption">
            <div class="banner">
              <div class="container">
                <div class="col-sm">
                  <h1><strong>TALLERES</strong></h1><br>
                  <p>"Aprende de los mejores en cursos y talleres especializados."</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="carousel-item">
        <img src="assets/img/carousel/Hackathon.jpg" loop class="d-block w-100 c-img" alt="Slide 3">
        <div class="container">
          <div class="carousel-caption">
            <div class="banner">
              <div class="container">
                <div class="col-sm">
                  <h1> <strong>HACKATHON</strong></h1><br>
                  <p>"Transforma tus ideas en soluciones"</a></p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="carousel-item">
        <img src="assets/img/carousel/Videojuegos.png" loop class="d-block w-100 c-img" alt="Slide 3">
        <div class="container">
          <div class="carousel-caption">
            <div class="banner">
              <div class="container">
                <div class="col-sm">
                  <h1> <strong>VIDEOJUEGOS</strong></h1><br>
                  <p>"Diviértete, juega sin límites y haz de cada partida una épica aventura digital"</a></p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>


      <div class="carousel-item">
        <img src="assets/img/carousel/Ajedrez.jpg" loop class="d-block w-100 c-img" alt="Slide 3">
        <div class="container">
          <div class="carousel-caption">
            <div class="banner">
              <div class="container">
                <div class="col-sm">
                  <h1> <strong>CONCURSOS</strong></h1><br>
                  <p>"¡Tu oportunidad de brillar y destacar!"</a></p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>



      <div class="carousel-item">
        <img src="assets/img/carousel/Musica.jpg" loop class="d-block w-100 c-img" alt="Slide 3">
        <div class="container">
          <div class="carousel-caption">
            <div class="banner">
              <div class="container">
                <div class="col-sm">
                  <h1> <strong>PRESENTACIONES MUSICALES</strong></h1><br>
                  <p>"Deleita tus sentidos con emocionantes presentaciones musicales."</a></p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>


      <div class="carousel-item">
        <img src="assets/img/carousel/Carrera.jpg" loop class="d-block w-100 c-img" alt="Slide 3">
        <div class="container">
          <div class="carousel-caption">
            <div class="banner">
              <div class="container">
                <div class="col-sm">
                  <h1> <strong>EVENTOS DEPORTIVOS</strong></h1><br>
                  <p>"Vive la emoción de la competencia en nuestros eventos deportivos."</p>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  </div>


  <div class="container-boton">
    <a href="registro.php" target="_blank">
      <img class="boton" src="assets/img/contenido/IconoRegistro.png" alt="IconoRegistro.png">
    </a>
  </div>


  <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header" style="background: #611232;">
          <h3 class="modal-title text-white"></h3>
          <i class='bx bx-x close' style='color:white; font-size:70px; text-align:left' data-dismiss="modal"
            aria-label="Close">
          </i>


        </div>
        <div class="modal-body">
          <img src="img/localizacion.png">
          <div class="contact-map">
            <iframe class="embed-responsive-item"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3737.251874389337!2d-99.1853968249838!3d20.49589848102339!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d15f8c7ed52a13%3A0x3e7267a79d64428b!2sUniversidad%20Tecnol%C3%B3gica%20del%20Valle%20del%20Mezquital!5e0!3m2!1ses-419!2smx!4v1709084736792!5m2!1ses-419!2smx"
              allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <br>
          <img src="img/rutas_2.png">
          <br><br>
          <h3 class="text-center" style="color:green;"><b>LÍNEA DE AUTOBUSES</b></h3>
          <div class="container">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>LÍNEA</th>
                    <th>COSTO</th>
                    <th>CENTRAL</th>
                    <th>RUTA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>

                    <td>OVNIBUS</td>
                    <td>$220</td>
                    <td>CENTRAL DEL NORTE</td>
                    <td>CDMX-IXMIQUILPAN</td>

                  </tr>
                  <tr>
                    <td>TF FRONTERA</td>
                    <td>$210</td>
                    <td>CENTRAL DEL NORTE </td>
                    <td>CDMX-IXMIQUILPAN</td>

                  </tr>
                  <tr>
                    <td>CONEXIÓN</td>
                    <td>$47</td>
                    <td>CENTRAL DE PACHUCA</td>
                    <td>PACHUCA-ACTOPANIXMIQUILPAN</td>

                  </tr>
                  <tr>
                    <td>PAI </td>
                    <td>$60</td>
                    <td>CENTRAL DE PACHUCA</td>
                    <td>PACHUCA-ACTOPANIXMIQUILPAN</td>
                  </tr>
                  <tr>
                    <td>FLECHA ROJA</td>
                    <td>
                      $55
                    </td>
                    <td>CENTRAL DE PACHUCA</td>
                    <td>PACHUCA-ACTOPANIXMIQUILPAN</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div <br><br>
          <h3 class="text-center" style="color:green;"><b>BASE DE TAXIS - 24 HORAS</b></h3>
          <div class="container">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>BASE</th>
                    <th>TElEFONO</th>
                    <th>DIRECCIÓN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>

                    <td>Sitio Juárez</td>
                    <td>(759)723 0035</td>
                    <td><a href="https://maps.app.goo.gl/EEXJrHGtfitNydWu5">
                        Av. Felipe Ángeles 46, Centro, 42300 Ixmiquilpan,Hgo.</a>
                    </td>

                  </tr>
                  <tr>
                    <td>Sitio Morelos</td>
                    <td>(759)7230377</td>
                    <td><a href="https://maps.app.goo.gl/wmzgseku6YBAGAZf6">
                        Álvaro Obregón, San Antonio, 42302 Ixmiquilpan, Hgo</a>
                    </td>

                  </tr>
                  <tr>
                    <td>Sitio San Antonio</td>
                    <td>(759)7233310</td>
                    <td><a href="https://maps.app.goo.gl/EEXJrHGtfitNydWu5">
                        42302, Av. Benito Pablo Juárez García 34, San Antonio, 42300 Ixmiquilpan, Hgo.</a>
                    </td>
                  </tr>
                  <tr>
                    <td>Sitio el Puente</td>
                    <td>(759)723 0035</td>
                    <td><a href="https://maps.app.goo.gl/r2qQ5SeVfeXvvvh26">
                        Av. Felipe Ángeles 46, Centro, 42300 Ixmiquilpan,Hgo.</a>
                    </td>
                  </tr>
                  <tr>
                    <td>Sitio Aurrera</td>
                    <td>(772)21419075</td>
                    <td><a href="https://maps.app.goo.gl/rSwHaTSz6WqT7bNN7">
                        Bodega Aurrera, San Antonio, 42302 Ixmiquilpan, Hgo.a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>



          <br><br>
          <h3 class="text-center" style="color:green;"><b>BASE DE COMBIS</b></h3>
          <div class="container">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>BASE</th>
                    <th>COSTO</th>
                    <th>RUTAS</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>

                    <td><a href="https://maps.app.goo.gl/NG7df8ZaAYzZjbdk8">Base San Antonio</a></td>
                    <td>De $15 a $70 (dependiendo el destino)</td>
                    <td>
                      De Ixmiquilpan a Grutas Tolantongo, la Gloria Tolantongo,
                      Centro Ecoturísticola Heredad, Centro Ecoturístico Koua, Centro
                      Ecoturístico La Lagunita en las Alturas, Centro Ecoturístico El
                      Banxú, Centro Ecoturístico, El Olivo y Centro Ecoturístico La
                      Purisíma.

                    </td>

                  </tr>
                  <tr>
                    <td><a href="https://maps.app.goo.gl/KTf7SmrGU1gCnWWT9">Base Combis El Tephé</a></td>
                    <td>De $10 a $18 (dependiendo el destino)</td>
                    <td>
                      De Ixmiquilpan a Balnearios: El Tephé, Te-pathé, Maguey Blanco, Dios Padre, Tollan , Valle
                      Paraíso, Pueblo Nuevo, Pastores y Centro Ecoturístico Taxhado.
                    </td>

                  </tr>
                  <tr>
                    <td><a href="https://maps.app.goo.gl/e3XksCRCdFDCc9HSA">Base de Combis Tlaco</a></td>
                    <td>De $20 a $25 (dependiendo el destino)</td>
                    <td>
                      De Ixmiquilpan a Balnearios: EcoAlberto, Centro Ecoturístico
                      El gran cañón Eco Alberto, El Dauthi, Las Cuevitas, Las Lajas Rojas,
                      El Manantial, Tlacotlapilco y Cabañas El Olivo.

                    </td>
                  </tr>
                  <tr>
                    <td><a href="https://maps.app.goo.gl/F5jcvwj3d5gThrRS9">Base de combis UTVM</a></td>
                    <td>De $9 a $25 (dependiendo el destino)</td>
                    <td>
                      UTVM, Nith, Capula, Bangando, La Estación
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>


        </div>

      </div>
    </div>
  </div>

  <!-- ACTIVIDADES -->

  <div id="Actividades">
    <img src="assets/img/contenido/pru2.jpg" width="500" alt="Actividades onza">
    <center>
      <div class="col-md-8">
        <p>Visualiza los diferentes actividades que ofrece el <br> <b style="color:#a57f2c;">CONGRESO ESTATAL DE
            TECNOLOGÍAS DE LA INFORMACIÓN <br>Y DESARROLLO DE SOFTWARE 2025</b><br>Seguridad informática el desafío en el futuro de la transformación digital.</p>
      </div>
    </center>
    <?php
    $path = "/assets/pdf/contenido/programa.pdf";

    // Verificar si existe el documento del programa
    if (file_exists($path)) {
      $programa = file_get_contents($path);

      header('Content-Type: application/pdf');

      echo $programa;
    } else {
      echo '<h3 style="text-align: center; width: 100%; height: 20px;"> Aun no existe un programa publicado en la plataforma </h3>';
    }

    ?>

    <section id="actividades" class="mt-5 text-center">
      <div class="seccion1">
        <div class="link-row 2">
          <div class="container">
            <div class="row">
              <div class="col">
                <a onclick="openContent(event, '1');" class="text-center text-decoration-none">
                  <div class="tablink border-0">Día 1</div>
                  <div class="seccionn"></div>
                </a>
              </div>
              <div class="col">
                <a onclick="openContent(event, '2');" class="text-center text-decoration-none">
                  <div class="tablink border-0">Día 2</div>
                </a>
              </div>
              <div class="col">
                <a onclick="openContent(event, '3');" class="text-center text-decoration-none">
                  <div class="tablink border-0">Día 3</div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="confes">
        <?php include "assets/partials/principal/actividades.php"; ?>
      </div>
    </section>
  </div>

  <br><br><br>

  <!--------------------------------------------------- Convocatorias --------------------------------------------------->

  <img src="assets/img/contenido/Con1.jpg" width="500">
  <div id="Convocatorias">
    <div class="seccion1">
      <div class="container">

        <div class="confes">
          <!--SECCION DE DEPORTES  -->

          <div class="seccion">
            <br><br>
            <?php include 'assets/partials/principal/convocatorias.php'; ?>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Participantes -->
    <br><br>
    <div id="Participantes">
    <img src="assets/img/contenido/parti1.jpg" width="500">
    </div>
    <p style="line-height: 2.0; text-align: center;">
      Conoce a nuestros distinguidos conferencistas, talleristas y egresadosen este evento<br> lleno de aprendizaje e
      inspiración. Únete a nosotros
      para una experiencia enriquecedora<br> en el <strong style="color:#a57f2c;">Congreso Estatal de Tecnologías de la
        Información y Desarrollo de Software 2025</strong>.
      <br>¡Te esperamos!
    </p>
    <div class="seccion1">
      <div class="link-row 2">
        <div class="container">
          <div class="row">
            <div class="col">
              <a onclick="openContent(event, '7');" class="text-center text-decoration-none">
                <div class="tablink border-0">Conferencistas</div>
              </a>
            </div>
            <div class="col">
              <a onclick="openContent(event, '8');" class="text-center text-decoration-none">
                <div class="tablink border-0">Talleristas</div>
                <div class="seccionn"></div>
              </a>
            </div>
            <div class="col">
              <a onclick="openContent(event, '9');" class="text-center text-decoration-none">
                <div class="tablink border-0">Egresados</div>
              </a>
            </div>

          </div>

          <div class="confes">
            <!--seccion de conferencista -->
            <div id="7" class="content">
              <div class="seccion">

                <?php include 'assets/partials/principal/conferencistas.php'; ?>

              </div>
            </div>

            <!--seccion de tallerista -->
            <div id="8" class="content">

              <div class="seccion">

                <?php include 'assets/partials/principal/talleristas.php'; ?>

              </div>
            </div>

            <!--seccion de egresados -->
            <div id="9" class="content">
              <div class="seccion">

                <?php include 'assets/partials/principal/egresados.php'; ?>

              </div>
            </div>
          </div>
        </div>
      </div>
      </section>
    </div>

  </div>

  <!-- PONENTES -->
  <br><br>
  <div id="Patrocinadores">
    <img src="assets/img/patrocinadores/patro1.jpg" width="500">
  </div>
  <div class="slider">
    <div class="slide-track">
      <div class="slide">
        <img src="assets/img/patrocinadores/1.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/2.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/3.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/4.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/5.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/6.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/7.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/8.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/9.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/10.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/11.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/12.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/13.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/14.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/15.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/16.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/17_c.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/18.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/19.png" alt="">
      </div>
      <div class="slide">
        <img src="assets/img/patrocinadores/20.png" alt="">
      </div>
    </div>
  </div>


  <script>
    // Script para ajustar automáticamente la altura de las imágenes en el carrusel
    window.addEventListener('load', function () {
      adjustImageHeights();
    });

    window.addEventListener('resize', function () {
      adjustImageHeights();
    });

    function adjustImageHeights() {
      var customCarousel = document.getElementById('customCarousel');
      var carouselItems = customCarousel.getElementsByClassName('slide');

      var maxHeight = 0;

      for (var i = 0; i < carouselItems.length; i++) {
        var img = carouselItems[i].querySelector('img');
        img.style.height = 'auto'; // Restablecer la altura para recalcular

        if (img.clientHeight > maxHeight) {
          maxHeight = img.clientHeight;
        }
      }

      for (var i = 0; i < carouselItems.length; i++) {
        var img = carouselItems[i].querySelector('img');
        img.style.height = maxHeight + 'px';
      }
    }
  </script>

  <br><br>

  <!-- Incluye la biblioteca jQuery y Popper.js (necesarios para el funcionamiento de Bootstrap) -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

  <!-- Incluye la biblioteca Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <a name="Contacto"></a>

  <!--------------------------------------------------- Footer --------------------------------------------------->
  <?php include "assets/partials/principal/footer.php"; ?>

</body>

</html>