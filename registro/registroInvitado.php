<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../assets/img/contenido/Icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Registro</title>

    <!-- ALERT -->
    <script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../node_modules/@fontsource/poppins/index.css">

    <!-- ICONOS -->
    <link href='../node_modules/boxicons/css/boxicons.min.css' rel='stylesheet'>

    <!-- ESTILO -->
    <link rel="stylesheet" href="../assets/css/registro/registroInvitado.css">
</head>

<body>
    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';
    
    include '../config/php/conexion.php';

    function mostrarAlerta($icon, $title, $text)
    {
        echo "<script>
                swal({
                    icon: '$icon',
                    title: '$title',
                    text: '$text',
                });
              </script>";
    }
    
    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }
    
    // Procesar el formulario si se envió
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registro'])) {
        // Recuperar datos del formulario
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellido'];
        $correo = $_POST['correo_electronico'];
        $contrasena = $_POST['contrasena'];
    
        // Validar que no haya campos vacíos
        if (empty($nombre) || empty($apellidos) || empty($correo) || empty($contrasena)) {
            mostrarAlerta('error', 'Error en el registro', 'Todos los campos son obligatorios. Por favor, completa el formulario.');
        } else {
            // Verificar si el correo electrónico ya existe en la base de datos
            $verificarCorreo = "SELECT correo FROM invitados WHERE correo = ?";
            $stmtVerificar = $conexion->prepare($verificarCorreo);
            $stmtVerificar->bind_param("s", $correo);
            $stmtVerificar->execute();
            $stmtVerificar->store_result();
            
            if ($stmtVerificar->num_rows > 0) {
                // El correo electrónico ya existe, muestra un mensaje de error
                mostrarAlerta('error', 'Error en el registro', 'El correo electrónico ya está registrado. Por favor, utiliza otro correo.');
            } else {
                // El correo electrónico no existe, procede con la inserción
                $stmtVerificar->close(); // Cerramos la consulta de verificación
            
                // Insertar datos en la base de datos utilizando una consulta preparada
                $sql = "INSERT INTO invitados (nombre, apellido, correo, contrasena) VALUES (?, ?, ?, ?)";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("ssss", $nombre, $apellidos, $correo, $contrasena);
            
                // Ejecutar la inserción
                if ($stmt->execute()) {
                    try {
                        // Configurar y enviar correo electrónico
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'congresoti@utvm.edu.mx';
                        $mail->Password = 'zusdecbpuqntjqrt';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;
    
                        $mail->setFrom('congresoti@utvm.edu.mx', 'CONGRESO ESTATAL UTVM 2024');
                        $mail->addAddress($correo);
    
                        $mail->isHTML(true);
                        $mail->CharSet = 'UTF-8';
    
                        $mail->Subject = "Bienvenido al congreso estatal 2024";
                        $mail->Body = "
                            <center><h1><b>¡BIENVENIDO AL PRIMER CONGRESO ESTATAL<br> DE TECNOLOGÍAS DE LA INFORMACIÓN Y DESARROLLO DE SOFTWARE 2024!</b></h1>
                            <h2>Las tecnologías disruptivas en un mundo globalizado</h2></center>
                            <br>
                            <br>Hola $nombre,
                            <br>
                            Te confirmamos que tu usuario ha sido registrado con éxito. A continuación, encontrarás los detalles de tu cuenta:
                            <br><br>
                            <b>- Usuario:</b> $correo<br>
                            <b>- Contraseña:</b> $contrasena<br>
                            <br>
                            Por favor, guarda esta información en un lugar seguro, a partir del viernes 15 de Marzo se podrá generar el reconocimiento.
                            <br>
                            ¡Esperamos verte en el Congreso Estatal 2024!
                            <br>
                            Saludos cordiales,
                            UTVM";
                        $mail->send();
    
                        mostrarAlerta('success', 'REGISTRADO', 'Tu usuario ha sido registrado con éxito.');
                    } catch (Exception $e) {
                        mostrarAlerta('error', 'Error en el registro', 'Hubo un problema al enviar el correo electrónico. Por favor, inténtalo nuevamente.');
                    }
                } else {
                    mostrarAlerta('error', 'Error en el registro', 'Hubo un problema al registrar el usuario. Por favor, inténtalo nuevamente.');
                }
    
                $stmt->close();
            }
        }
    }
    
    // Cierra la conexión al final del archivo
    $conexion->close();
    ?>


  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 py-md-4 mb-4 border-bottom  container-fluid" style="background: linear-gradient(to bottom,#611232, #611232,#611232); margin-bottom: 0;">
   <div class="col-12 col-md-3 mb-2 mb-md-0 text-center">
            <a href="../index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="../assets/img/contenido/LogoUTVM.png" width="150" alt="logo">
            </a>
            <a href="../index.php" class="text-white text-decoration-none">
                <br><i class='bx bx-left-arrow-alt bx-flashing' style='color:#ffffff' ></i>Inicio
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2 text-center">
            <h5 class="text-white"><b>REGISTRO AL CONGRESO ESTATAL 2024 </b></h5>
        </div>

        <div class="col-12 col-md-3 text-center mt-2 mt-md-0">
            <a href="../registro.php" class="btn btn-outline-personal text-white me-2 btn-sm">Registrarse</a>
            <a href="../login.php" class="btn text-white" style="background: linear-gradient(to bottom, #5CE896, #45AB46, #40CB41);">Iniciar sesión</a>
        </div>
    </header>
 <div class="container marketing text-center">

    <div class="image-container hide-on-mobile"  style="width: 50%; margin-right: 20px;">
        <img class="card-img-top sombra" src="../assets/img/contenido/Onza.png" alt="Imagen de fondo" style="width: 100%;">
    </div>

    <!-- Contenido del card -->
    <div class="card">
        <div class="card-body">
            <br>
            <form method="post" class="align-items-center">
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="nombre" class="col-sm col-form-label">Nombre:</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label for="apellido" class="col-sm col-form-label">Apellidos completos:</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="correo_electronico" class="col-sm col-form-label">Correo electrónico:</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" placeholder="Ejemplo@gmail.com">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col">
                    <div class="form-group row">
                        <label for="contrasena" class="col-sm col-form-label">Contraseña:</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="confirmar_contrasena" class="col-sm col-form-label">Confirmar Contraseña:</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Confirmar Contraseña">
                            <div id="mensaje-error" class="text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <br><br>
                    <button type="button" class="btn text-white" style="background: linear-gradient(to bottom, #0E773F, #008735, #035223);" name="validar" id="validar">Validar</button>
                    <button type="submit" class="btn text-white" disabled style="background: linear-gradient(to bottom, #A12043, #2b0101); margin-bottom: 0;" name="registro" id="registro">Registrarse</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        // Función para mostrar una alerta de éxito
        function mostrarExito(mensaje) {
            swal({
                icon: 'success',
                title: 'Éxito',
                text: mensaje,
            });
        }

        // Función para mostrar una alerta de error
        function mostrarError(mensaje) {
            swal({
                icon: 'error',
                title: 'Error',
                text: mensaje,
            });
        }

        function comprobarClave() {
            var contrasena = document.getElementById('contrasena').value;
            var confirmar_contrasena = document.getElementById('confirmar_contrasena').value;

            if (contrasena.trim() === "" || confirmar_contrasena.trim() === "") {
                mostrarError('No se permiten contraseñas vacías');
                $('#registro').prop('disabled', true);
                return;
            }

            if (contrasena === confirmar_contrasena) {
                mostrarExito('Contraseñas validadas. Sigue con el registro');
                $('#registro').prop('disabled', false);
            } else {
                mostrarError('Error al validar contraseñas. Asegúrate de ingresar la misma contraseña en ambos campos');
                $('#registro').prop('disabled', true);
            }
        }

        document.getElementById('validar').addEventListener('click', comprobarClave);
    </script>
</body>

</html>
