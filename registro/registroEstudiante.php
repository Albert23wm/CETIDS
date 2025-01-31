<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../img/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Registro Estudiante</title>

    <!-- ALERT -->
    <script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../node_modules/@fontsource/poppins/index.css">

    <!-- ICONOS -->
    <link href='../node_modules/boxicons/css/boxicons.min.css' rel='stylesheet'>

    <!-- ESTILOS -->
    <link rel="stylesheet" href="../assets/css/registro/registroEstudiante.css">
</head>

<body>
    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';

    include '../config/php/conexion.php';

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    // Procesar el formulario si se envió
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registro'])) {
        $matricula = $conexion->real_escape_string($_POST["matricula"]);
        $nombre_estudiante = $conexion->real_escape_string($_POST["nombre_estudiante"]);
        $apellido = $conexion->real_escape_string($_POST["apellido"]);
        $unidad_academica = $conexion->real_escape_string($_POST["unidad_academica"]);
        $grado = $conexion->real_escape_string($_POST["grado"]);
        $correo_electronico = $conexion->real_escape_string($_POST["correo_electronico"]);
        $contrasena = $conexion->real_escape_string($_POST["contrasena"]);

        // Verificar si el usuario ya existe
        $check_id_query = "SELECT * FROM estudiantes WHERE matricula = '$matricula' AND institucion = '$unidad_academica'";
        $result = $conexion->query($check_id_query);

        if ($result->num_rows > 0) {
            echo '
                <script>
                    swal({
                        icon: "error",
                        title: "Oops...",
                        text: "El usuario ya está registrado",
                        button: "X",
                    });
                </script>';
        } else {
            // Enviar el código por correo electrónico
            $mail = new PHPMailer(true);
            // Insertar el nuevo estudiante en la base de datos
            $insert_query = "INSERT INTO estudiantes (matricula, nombre, apellido, institucion, grado, correo, contrasena) VALUES ('$matricula', '$nombre_estudiante', '$apellido', '$unidad_academica', '$grado','$correo_electronico', '$contrasena')";

            if ($conexion->query($insert_query) === TRUE) {
                echo '
                    <script>
                        swal({
                            icon: "success",
                            title: "¡REGISTRADO!",
                            text: "Tu usuario ha sido registrado con éxito",
                            button: "Cerrar"
                        });
                    </script>';

                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
                    $mail->SMTPAuth = true;
                    $mail->Username = 'congresoti@utvm.edu.mx';
                    $mail->Password = 'zusdecbpuqntjqrt';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('congresoti@utvm.edu.mx', 'CONGRESO ESTATAL UTVM 2024');
                    $mail->addAddress($correo_electronico);

                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';

                    $mail->Subject = "Bienvenido al congreso estatal 2024";
                    $mail->Body = "
                        <center>
                            <h1><b>¡BIENVENIDO AL PRIMER CONGRESO ESTATAL<br> DE TECNOLOGÍAS DE LA INFORMACIÓN Y DESARROLLO DE SOFTWARE 2024!</b></h1>
                            <h2>Las tecnologías disruptivas en un mundo globalizado</h3>
                        </center>
                        <br>
                        <br>Hola $nombre_estudiante,
                        <br>
                        Te confirmamos que tu usuario ha sido registrada con éxito. A continuación, encontrarás los detalles de tu cuenta:
                        <br><br>
                        <b>- Usuario:</b> $matricula<br>
                        <b>- Contraseña:</b> $contrasena<br>
                        <br>
                        Por favor, guarda esta información en un lugar seguro, a partir del viernes 15 de Marzo se podrá generar el reconocimiento.
                        <br>
                        Puedes descargar tu reconocimiento, una vez concluido el Congreso. ¡Qué disfrutes tus conferencias y Talleres!
                        <br>
                        Saludos cordiales,
                        UTVM";
                    $mail->send();
                } catch (Exception $e) {
                    echo "No se envió confirmación a tu correo";
                }
            } else {
                echo "Error en el registro: " . $conexion->error;
            }
        }
    }

    // Cerrar la conexión a la base de datos al final del script
    $conexion->close();
    ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Ocultar ambos formularios al inicio
            $('#formEstudiante').hide();
            $('#formInvitado').hide();

            $('#rol').change(function () {
                var selectedRol = $(this).val();
                if (selectedRol === 'estudiante') {
                    $('#formEstudiante').show();
                    $('#formInvitado').hide();
                } else if (selectedRol === 'invitado') {
                    $('#formEstudiante').hide();
                    $('#formInvitado').show();
                }
            });

            // Mostrar u ocultar el campo "Especifica" según la selección de institución
            $('#unidad_academica').change(function () {
                var selectedOption = $(this).val();
                if (selectedOption === 'otra') {
                    $('#otra_institucion_container').show();
                } else {
                    $('#otra_institucion_container').hide();
                }
            });
        });
    </script>
    </head>

    <header
        class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 py-md-4 mb-4 border-bottom  container-fluid"
        style="background: linear-gradient(to bottom, #611232, #611232,#611232); margin-bottom: 0;">

        <div class="col-12 col-md-3 mb-2 mb-md-0 text-center">
            <a href="../index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="../assets/img/contenido/LogoUTVM.png" width="150" alt="logo">

            </a>
            <a href="../index.php" class="text-white text-decoration-none">
                <br><i class='bx bx-left-arrow-alt bx-flashing' style='color:#ffffff'></i>Inicio
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2 text-center">
            <h5 class="text-white"><b>REGISTRO AL CONGRESO ESTATAL 2024 <br>
                    <h4>Estudiante</h4>
                </b></h5>
        </div>

        <div class="col-12 col-md-3 text-center mt-2 mt-md-0">
            <a href="../registro.php" class="btn btn-outline-personal text-white me-2 btn-sm">Registrarse</a>
            <a href="../login.php" class="btn text-white"
                style="background: linear-gradient(to bottom, #5CE896, #45AB46, #40CB41);">Iniciar sesión</a>
        </div>
    </header>

    <div class="container marketing text-center">

        <div class="image-container hide-on-mobile" style="width: 50%; margin-right: 20px;">
            <img class="card-img-top sombra" src="../assets/img/contenido/Onza.png" alt="Imagen de fondo"
                style="width: 100%;">
        </div>

        <!-- Contenido del card -->

        <div class="container marketing text-center">
            <!-- Contenido del card -->
            <div class="card">
                <div class="card-body">
                    <form method="post" class="align-items-center" id="registroForm"
                        onsubmit="return validarFormulario()">
                        <div class="row">
                            <div class="col">
                                <div class="form-group row">
                                    <label for="nombre_estudiante" class="col-sm col-form-label">Nombre:</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="nombre_estudiante"
                                            name="nombre_estudiante" placeholder="Nombre">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group row">
                                    <label for="apellido" class="col-sm col-form-label">Apellidos:</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="apellido" name="apellido"
                                            placeholder="Apellidos">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="form-group row">
                                    <label for="correo_electronico" class="col-sm col-form-label">Correo
                                        electrónico:</label>
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control" id="correo_electronico"
                                            name="correo_electronico" placeholder="Ejemplo@gmail.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="form-group row">
                                    <label for="unidad_academica" class="col-sm col-form-label">Institución:</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" id="unidad_academica" name="unidad_academica">
                                            <option value=""></option>
                                            <option value="UTVM">UTVM</option>
                                            <option value="UAT">UAT</option>
                                            <option value="ITSOEH">ITSOEH</option>
                                            <option value="UPFIM">UPFIM</option>
                                            <option value="otra">Otra Institución</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Campo de texto para la opción "Otra Institución" -->
                                <div class="form-group row" id="otra_institucion_container" style="display:none;">
                                    <label for="otra_institucion" class="col-sm col-form-label">Especifica:</label>
                                    <div class="col-sm-12">
                                        <!-- Cambiado el nombre del campo de texto para diferenciarlo -->
                                        <input type="text" class="form-control" id="otra_institucion"
                                            name="otra_institucion_text" placeholder="Escribe la institución">
                                    </div>
                                </div>
                            </div>




                            <script>
                                // Script para mostrar/ocultar el campo de texto según la selección en la lista desplegable
                                document.getElementById('unidad_academica').addEventListener('change', function () {
                                    var otraInstitucionContainer = document.getElementById('otra_institucion_container');
                                    var selectedOption = this.value;

                                    if (selectedOption === 'otra') {
                                        otraInstitucionContainer.style.display = 'block';
                                    } else {
                                        otraInstitucionContainer.style.display = 'none';
                                    }
                                });
                            </script>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="grado" class="col-sm col-form-label">Semestre/Cuatrimestre:</label>
                                        <div class="col-sm-12">
                                            <select class="form-select" id="grado" name="grado">
                                                <option value=""></option>
                                                <option value="1">1°</option>
                                                <option value="2">2°</option>
                                                <option value="3">3°</option>
                                                <option value="4">4°</option>
                                                <option value="5">5°</option>
                                                <option value="6">6°</option>
                                                <option value="7">7°</option>
                                                <option value="8">8°</option>
                                                <option value="9">9°</option>
                                                <option value="10">10°</option>
                                                <option value="11">11°</option>
                                                <option value="otro">Otro</option>
                                            </select>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="matricula" class="col-sm col-form-label">Matrícula:</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="matricula"
                                                        name="matricula" placeholder="Matrícula"
                                                        onkeypress="return isNumberKey(event)" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row" id="otro_grado_container" style="display:none;">
                                        <label for="otro_grado" class="col-sm col-form-label">Especifica:</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="otro_grado" name="otro_grado"
                                                placeholder="Escribe el grado">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                            <!-- Añadí SweetAlert -->

                            <script>
                                function comprobarClave() {
                                    // Cambié "clave1" y "clave2" a "contrasena" y "confirmar_contrasena"
                                    var contrasena = document.getElementById('contrasena').value;
                                    var confirmar_contrasena = document.getElementById('confirmar_contrasena').value;

                                    // Agregué la condición para verificar si hay espacios vacíos en las contraseñas
                                    if (contrasena.trim() === "" || confirmar_contrasena.trim() === "") {
                                        swal('Error', 'No se permiten contraseñas vacías', 'error');
                                        // Deshabilitar el botón de "Registrarse"
                                        $('#registro').prop('disabled', true);
                                        return;
                                    }

                                    if (contrasena === confirmar_contrasena) {
                                        // Cambié alert por SweetAlert para el caso positivo
                                        swal('Contraseñas Validadas', 'Sigue con el registro', 'success');
                                        // Habilitar el botón de "Registrarse"
                                        $('#registro').prop('disabled', false);
                                    } else {
                                        // Cambié alert por SweetAlert para el caso negativo
                                        swal('Error al validar contraseñas', 'Asegúrate de ingresar la misma contraseña en ambos campos', 'error');
                                        // Deshabilitar el botón de "Registrarse"
                                        $('#registro').prop('disabled', true);
                                    }
                                }

                                // Usar jQuery para manejar el evento click del botón "Validar"
                                $('#validar').click(function () {
                                    // Llamada a la función comprobarClave
                                    comprobarClave();
                                });
                            </script>


                            <div class="col">
                                <div class="form-group row">
                                    <label for="contrasena" class="col-sm col-form-label">Contraseña:</label>
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control" id="contrasena" name="contrasena"
                                            placeholder="Contraseña">
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group row">
                                    <label for="confirmar_contrasena" class="col-sm col-form-label">Confirmar
                                        Contraseña:</label>
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control" id="confirmar_contrasena"
                                            name="confirmar_contrasena" placeholder="Confirmar Contraseña">
                                        <div id="mensaje-error" class="text-danger"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <br><br>
                                <button type="button" class="btn text-white"
                                    style="background: linear-gradient(to bottom, #0E773F, #008735, #035223);"
                                    name="validar" id="validar">Validar</button>
                                <button type="submit" class="btn text-white" disabled
                                    style="background: linear-gradient(to bottom, #A12043, #2b0101); margin-bottom: 0;"
                                    name="registro" id="registro">Registrarse</button>
                            </div>




                            <script>
                                // Usar addEventListener para asociar la función comprobarClave al botón
                                document.getElementById('validar').addEventListener('click', comprobarClave);
                            </script>

                        </div>
                </div>

                </form>
            </div>
        </div>


        <script>
            function validarFormulario() {
                var nombreEstudiante = document.getElementById("nombre_estudiante").value;
                var apellido = document.getElementById("apellido").value;
                var unidadAcademica = document.getElementById("unidad_academica").value;
                var grado = document.getElementById("grado").value; // Asegúrate de tener el elemento con id "grado"
                var correoElectronico = document.getElementById("correo_electronico").value;
                var contrasena = document.getElementById("contrasena").value;

                if (
                    nombreEstudiante === "" ||
                    apellido === "" ||
                    unidadAcademica === "" ||
                    grado === "" || // Nueva validación para grado
                    correoElectronico === "" ||
                    contrasena === ""
                ) {
                    swal({
                        icon: "error",
                        title: "¡ERROR!",
                        text: "Llena todos los campos, por favor",
                        button: "Cerrar"
                    });
                    return false; // Evita que el formulario se envíe
                }
                return true;
            }
        </script>