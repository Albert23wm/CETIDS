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
  
<style>
  * {
    cursor: url("cr.png"), auto;
}

a,
.btn,
button {
    cursor: url("cr_o.png"), auto;
    text-decoration: none;
}


.btn_favorite {
    border-bottom: 1px solid hsl(0, 0%, 100%);
    text-shadow: 0 1px 0 hsla(0, 0%, 0%, 0.2);
    text-decoration: none !important;
    text-transform: uppercase;
    color: #fff !important;
    font-weight: bold;
    border-radius: 5px;
    padding: 10px 20px;
    margin: 0 3px;
    position: relative;
    display: inline-block;
    -webkit-transition: all 0.1s;
    -moz-transition: all 0.1s;
    -o-transition: all 0.1s;
    transition: all 0.1s;
}

.btn_favorite:active {
    -webkit-transform: translateY(7px);
    -moz-transform: translateY(7px);
    -o-transform: translateY(7px);
    transform: translateY(7px);
}

.btn_favorite {
    background: #5e1710;
    ;
    box-shadow: 0 10px 0 #350a06,
        0 11px 5px hsla(0, 0%, 0%, 0.5);
}

.btn_favorite:active {
    box-shadow: 0 3px 0 #3a0303,
        0 4px 6px hsla(0, 0%, 0%, 0.7);
}

.btn_favorite {
    border-bottom: 1px solid hsla(0, 0%, 100%, 0.2);
    text-shadow: 0 1px 0 hsla(0, 0%, 0%, 0.2);
    text-decoration: none !important;
    text-transform: uppercase;
    color: #fff !important;
    font-weight: bold;
    border-radius: 5px;
    padding: 10px 20px;
    margin: 0 3px;
    position: relative;
    display: inline-block;
    -webkit-transition: all 0.1s;
    -moz-transition: all 0.1s;
    -o-transition: all 0.1s;
    transition: all 0.1s;
}

.btn_favorite:active {
    -webkit-transform: translateY(7px);
    -moz-transform: translateY(7px);
    -o-transform: translateY(7px);
    transform: translateY(7px);
}

.btn_favorite {
    background: #5e1710;
    box-shadow: 0 10px 0 #350a06,
        0 11px 5px hsla(0, 0%, 0%, 0.5);
}

.btn_favorite:active {
    box-shadow: 0 3px 0 #5e1710,
        0 4px 6px hsla(0, 0%, 0%, 0.7);
}

.banner {
    background-color: #0500008e;
    width: 100%;
    padding: 2em 0;
}

.row {
    align-items: center;
}

h1 {
    text-shadow: 1px 1px 2px #7c7c7c;
}

.btn {
    padding: 0.5em 2em;
    border-radius: 2em;
    box-shadow: 5px 5px 5px rgba(105, 73, 73, 0.15);
}

body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

header {
    background: linear-gradient(to bottom, #3a0303, #691616, #740b0b, #2b0101);
    text-align: center;
    padding: 10px 0;
    margin-bottom: 10px;
}

img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: auto;
}

nav {

    text-align: center;
    padding: 10px 0;
    margin-bottom: 10px;
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
}

nav ul li {
    margin: 0 10px;
}

nav ul li a {
    text-decoration: none;
    color: white;
}

.carousel {
    position: relative;
    z-index: 0;
    /* Establece el z-index del carrusel a 0 */
}

.redes {
    position: relative;

    left: 45%;
}

/* Establece un z-index más alto para la imagen y el menú */
header,
nav {
    position: relative;
    z-index: 1;
    background: linear-gradient(to bottom, #611232, #611232); /* Cambio de color Barra menu -SHOWI */
    margin-bottom: 0;
    margin-bottom: 0;
}

#iso-img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: auto;
}

/*Estilos del menu*/

#btn-menu {
    display: none;
}

header label {
    font-size: 30px;
    cursor: pointer;
    display: none;

}

.menu ul {
    display: flex;
    list-style: none;
}

.menu ul ul {
    display: none;
}

.menu a {
    display: block;
    padding: 15px 20px;
    color: #FFF;
}

.menu a i {
    margin-left: 10px;
}

.menu ul li:hover ul {
    transition: all 0.3s ease;
    display: block;
    position: absolute;
}

.nav__logo {
    font-size: 2.5rem;
    z-index: 1;
    width: 100%;
}

@media (max-width: 767px) {

    /* Oculta la imagen en dispositivos con un ancho de pantalla menor a 767px */
    .hide-on-mobile {
        display: none !important;
        /* Agrega !important para asegurarte de que el estilo se aplique */
    }

    header label {
        display: block;
        padding-top: 16px;
        padding-right: 16px;
        transition: all 0.4s ease;
    }

    .menu {
        position: absolute;
        top: 80px;
        left: 0;
        width: 50%;
        transform: translateX(-100%);
        transition: all 0.3s;
    }

    .menu ul {
        flex-direction: column;
    }

    .menu ul li:hover ul {
        display: none;
        position: static;
    }

    .menu a i {
        position: absolute;
        right: 16px;
        line-height: 32px;
    }

    #btn-menu:checked~.menu {
        transform: translateX(0%);
    }

    .tablink {
        font-size: 14px;
        /* Tamaño de la fuente reducido para pantallas más pequeñas */
        padding: 8px 16px;
        /* Reducción del espaciado para los botones en pantallas más pequeñas */
    }


}

.galeria {
    display: flex;
    margin: auto;
    max-width: 100%;
    /* Cambiado de 950px a 100% */
    height: auto;
}

.galeria img {
    width: 0;
    /* Cambiado de 0px a 0 */
    flex-grow: 1;
    object-fit: cover;
    /* filter: brightness(80%); */
    transition: width 0.7s ease, opacity 0.7s ease, filter 0.7s ease;
    /* Cambiado para incluir las propiedades de transición */
}

.galeria img:hover {
    width: 0%;
    opacity: 1;
    filter: brightness(100%);
}

.tablink-container {
    display: inline-block;
    position: relative;
}

.tablink {
    cursor: pointer;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #a57f2c;  /* Color botones de dias -SHOWI*/
    color: white;
    transition: background-color 0.3s ease, color 0.3s ease;
    position: relative;
}

.tablink-container:hover .tablink,
.tablink-active {
    background: linear-gradient(to bottom,#611232, #a04e62); color:white; /* Color botones de dias -SHOWI*/
        color: #fff;
}

.tablink-underline {
    border-bottom: 2px solid transparent;
    transition: border-bottom 0.3s ease;
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
}

.tablink-container:hover .tablink-underline,
.tablink-container.tablink-active .tablink-underline {
    border-bottom: 2px solid #fff;
}

.seccionn {
    width: 80%;
    height: 5px;
    background-color: #A12043;
    display: none;
    /* Inicialmente oculto */
    position: absolute;
    top: calc(100% + 5px);
    /* Posiciona debajo del texto del enlace */
    left: 50%;
    transform: translateX(-50%);
}

.tablink-container:hover .seccionn,
.tablink-container.tablink-active .seccionn {
    display: block;
}

.content {
    display: none;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th,
.table td {
    border: none;
    padding: 15px;
    text-align: left;
    background-color: #f8f9fa;
    /* Color de fondo predeterminado */
    color: #495057;
    /* Color del texto predeterminado */
    transition: background-color 0.3s ease, color 0.3s ease;
    /* Transición suave */
}

.table th {
    /* background: linear-gradient(to bottom, #0E773F, #008735,#035223); */
    background-color:#a57f2c; /* Color de la tabla -SHOWI */
    color: #fff;
    /* Color del texto del encabezado */
}


.imagen-flotante {
    position: fixed;
    bottom: 10px;
    /* Ajusta la posición vertical según tus necesidades */
    right: 0.2px;
    transform: translateX(-50%);
    /* Centra la imagen correctamente */

}

a {
    text-decoration: none;
    /* Quitar subrayado */
    color: #000000;
    /* Cambiar color (puedes poner el color que desees en formato hexadecimal, RGB, nombre, etc.) */
}




/* CARDS PARA CONVOCATORIA */

.seccion {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.card {
    width: 300px;
    margin: 10px;
    text-align: center;
    border-radius: 5%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border: 1px solid transparent;
    overflow: hidden;
}

.image {
    width: 100%;
    height: auto;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image img {
    width: 500px;
    /* Ajusta el ancho máximo de la imagen */
    height: 200px;
    object-fit: cover;
}

.name_p {
    background-color: #952d3d;
}

@media (max-width: 768px) {
    .card {
        width: 100%;
    }
}

.cerrar {
    display: block;
    background: #952d3d;
    width: 100px;
    margin: 15px auto;
    text-align: center;
    text-decoration: none;
    font-size: 25px;
    padding: 5px;
    line-height: 25px;
    color: #ffffff;
    border-radius: 5%;
}

.modal-content-pro {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 800px;
    height: 500px;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
}

#pdfContainer {
    width: 100%;
    height: 100%;
}

@media only screen and (max-width: 600px) {
    .modal-content-pro {
        width: 90%;
        /* Ajustado para dispositivos muy pequeños */
    }
}

.parti:hover {
    color: #a57f2c;
    font-weight: bold;
    transform: scale(1.2);
    /* Ajusta el valor según tu preferencia */

}
.btn-success {
    background-color: #a57f2c; /* Mantener el marrón claro en el fondo */
    border-color: #8b5e3c;     /* Cambiar el borde a un marrón más oscuro */
}

/*btn flotante*/

.container-boton {

    border: .5px solid #fff;
    position: fixed;
    z-index: 80;
    border-radius: 50%;
    bottom: 5px;
    right: 5px;
    padding: 5px;
    transition: ease 0.3s;
    animation: efecto 1.2s infinite;
}

.container-boton:hover {
    transform: scale(1.1);
    transition: 0.3s;
}

.boton {
    width: 120px;
    transition: ease 1s;
}

@keyframes efecto {
    0% {
        box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.85);
    }

    100% {
        box-shadow: 0 0 0 25px rgba(0, 0, 0, 0);
    }
}

/*Estilos para hacer el fondo del submenu  */
.dropdown-menu {
    background: linear-gradient(to bottom,#611232, #a04e62);
    border: none;
}


.dropdown-item {
    color: rgba(255, 255, 255, 0.8);
    /* Puedes ajustar el valor alpha según tus preferencias */
}

.dropdown-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    /* Puedes ajustar el valor alpha según tus preferencias */
}

.contact-map {
    width: 80%;
    height: 50%;
    margin: auto;
    display: flex;
    flex-wrap: wrap;
    padding: 2vw;
    /* Utilizamos unidades relativas para hacerlo más flexible */
    border-radius: 10px;
    background: #fff;
    box-shadow: 0px 0px 10px 0px #666;
    display: grid;
    align-items: center;
}

/* Utilizamos consultas de medios para ajustar los estilos en diferentes tamaños de pantalla */
@media only screen and (min-width: 600px) {
    .contact-map {
        padding: 20px;
    }
}

.contact-map iframe {
    width: 100%;
    height: 100%;
}

.slider {
    width: 75vw;
    height: auto;
    margin: auto;
    overflow: hidden;
}

.slider .slide-track {
    display: flex;
    animation: scroll 60s linear infinite;
    -webkit-animation: scroll 60s linear infinite;
    width: calc(200px * 20);
}

.slider .slide {
    width: 200px;
}

.slider .slide img {
    width: 100%;
}

@keyframes scroll {
    0% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
    }

    100% {
        -webkit-transform: translateX(calc(-200px * 18));
        transform: translateX(calc(-200px * 18));
    }
}

/**************************************** Style.css ****************************************/
* {
    font-family: 'poppins';

}

.s {
    pointer-events: none;
}

.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;

    }
}

.no-download {
    pointer-events: none;
}

.b-example-divider {
    width: 100%;
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
}

.b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
}

.bi {
    vertical-align: -.125em;
    fill: currentColor;
}

.nav-scroller {
    position: relative;
    z-index: 2;
    height: 2.75rem;
    overflow-y: hidden;
}

.nav-scroller .nav {
    display: flex;
    flex-wrap: nowrap;
    padding-bottom: 1rem;
    margin-top: -1px;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
}



.bd-mode-toggle {
    z-index: 1500;
}

.bd-mode-toggle .dropdown-menu .active .bi {
    display: block !important;
}


.navbar {
    height: 95px;
}


.sombra {
    filter: drop-shadow(12px 12px 5px rgba(0, 0, 0, 0.397));
}

.navbar-brand {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
}



@media screen and (max-width: 567px) {
    .banner {
        text-align: center;
    }
}

/*carrusel*/
.midon img {
    height: 76vh;
}

/*IMAGENES CARRUSEL*/
.c-item {
    height: 480px;
}

.c-img {
    height: 100%;
    object-fit: cover;
}

/* .card {
      border:none;
      text-align: center;
      border-top-left-radius: 10em;
      border-top-right-radius: 10em;
      box-shadow: 0px 0px 10px teal;
    }
    .card img {
      border-top-left-radius: 10em;
      border-top-right-radius: 10em;
    }
    .btn_p {
      width: 100%;
      padding: 0.75em 0.5em;
      border-radius: 0;
      background-color: teal;
      border-color: teal;
    } */
.btn-outline-personal {
    border-color: #beffdd;
}

.card {

    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}

.swal-button {
    background-color: #611232 !important;
    color: #FFFFFF !important;
    /* Puedes agregar más estilos según tus preferencias */
}

/* carrusel ponnetes */
/* Animación de desplazamiento continuo */
@keyframes scrollPonentes {
    0% {
        transform: translateX(0%);
    }

    100% {
        transform: translateX(-100%);
    }
}

.carousel-ponentes {
    display: flex;
    gap: 1rem;
    /* Espacio entre elementos */
    animation: scrollPonentes 10s linear infinite;
    /* Duración de la animación */
    width: 200%;
    /* Asegura que los elementos tengan espacio para desplazarse */
    overflow: hidden;
    /* Oculta los elementos que desbordan el contenedor */
}

.carousel-item-ponente {
    flex: 1 0 100%;
    /* Ocupa todo el espacio disponible */
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    /* Alinea los elementos verticalmente */
}

.nombre-ponente {
    margin-top: 10px;
    /* Espacio superior para el nombre */
}

.imagen-ponente {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    /* Forma la imagen como un círculo */
}

.carousel-container {
    width: 100%;
    overflow: hidden;
    margin: 0 auto;
    /* Centra el carrusel */
    max-width: 800px;
    /* Ancho máximo del carrusel */
}

@media (max-width: 767px) {

    /* Oculta la imagen en dispositivos con un ancho de pantalla menor a 767px */
    .hide-on-mobile {
        display: none !important;
        /* Agrega !important para asegurarte de que el estilo se aplique */
    }
}
  </style>
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
                    <a class="btn btn-lg btn_favorite align-items-center" href="login.php"
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

  <img src="assets/img/contenido/con1.jpg" width="500" alt="Actividades onza">
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