<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Participantes</title>
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
            <h5 class="text-white "><b>PARTICIPANTES</b></h5>
        </div>

        <div class="col-6 col-md-3 text-end">
            <i class='bx bx-menu navbar-toggler' type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation"
                style='color:#ffffff; font-size: 50px;'>
            </i>
        </div>
    </header>

    <?php include_once "../assets/partials/administrador/menu.php"; ?>

    <br><br><br><br><br><br>

    <div class="container marketing text-center">
        <a href="ponentes/agregarPonente.php" style="text-align: right;">
            <img src="../assets/img/contenido/añadir.png" width="8%">
        </a>
        <h5 class="text-center" style="color:#611232;"><b>Nuevo participante</b></h5>
        <br>

        <?php
        // Conexión a la base de datos
        include("../config/php/conexion.php");

        // Obtener los datos de la bd
        $consulta = "SELECT * FROM ponentes";

        $resultados = mysqli_query($conexion, $consulta);

        // Convertir a arreglo
        $filas = [];
        while ($fila = mysqli_fetch_assoc($resultados)) {
            $filas[] = $fila;
        }

        if ($resultados && mysqli_num_rows($resultados) > 0): ?>
            <table class="table table-striped table-bordered table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Descripción</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($filas as $fila): ?>
                        <tr>

                            <?php if (isset($fila['url_foto'])): ?>
                                <td>
                                    <div class="rounded-circle mx-auto d-block overflow-hidden"
                                        style="width: 100px; height: 100px;">
                                        <img src="../<?php echo $fila['url_foto']; ?>" alt="Foto de perfil" class="img-fluid"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </td>
                            <?php else: ?>
                                <td><i class="bx bxs-user-circle" style="font-size: 5em; color: #cccccc;"></i></td>
                            <?php endif; ?>

                            <td><?php echo $fila['nombre']; ?></td>
                            <td><?php echo $fila['apellido']; ?></td>
                            <td><?php echo $fila['descripcion']; ?></td>
                            <td><?php echo $fila['rol']; ?></td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#editarPonenteModal<?php echo $fila['id']; ?>">
                                    <i class="bx bx-edit" style="color:#ba6057; font-size: 50px;"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#eliminarPonenteModal<?php echo $fila['id']; ?>">
                                    <i class="bx bxs-trash" style="font-size: 50px; color:#FFBDB7;"></i>
                                </a>    
                            </td>
                                </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Modales -->
                <?php foreach ($filas as $fila): ?>
                        <!-- Modal para Editar Ponente -->
                        <div class="modal fade" id="editarPonenteModal<?php echo $fila['id']; ?>" tabindex="-1" role="dialog"
                            aria-labelledby="editarPonenteModalLabel<?php echo $fila['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarPonenteModalLabel<?php echo $fila['id']; ?>">
                                            Editar datos del ponente
                                        </h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../controllers/admin/ponentes/editarPonente.php" method="POST"
                                            enctype="multipart/form-data">
                                            <?php include 'ponentes/editarPonente.php'; ?>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para Eliminar Ponente -->
                        <div class="modal fade" id="eliminarPonenteModal<?php echo $fila['id']; ?>" tabindex="-1" role="dialog"
                            aria-labelledby="eliminarPonenteModalLabel<?php echo $fila['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="eliminarPonenteModalLabel<?php echo $fila['id']; ?>">
                                            Confirmar Eliminación
                                        </h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro de que deseas eliminar los datos del participante 
                                            <strong><?php echo $fila['nombre'] . ' ' . $fila['apellido']?></strong>?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- Formulario para eliminar -->
                                        <form action="../controllers/admin/ponentes/eliminarPonente.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                                            <button type="submit" name="eliminar" class="btn btn-danger">Eliminar</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach; ?>
        <?php else: ?> 
            <p>No hay ponentes registrados.</p>
        <?php endif;

        $conexion->close();

        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>