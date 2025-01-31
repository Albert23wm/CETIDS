<?php

$sql = "SELECT a.id, a.nombre, a.asistentes, a.fecha, a.dia, a.hora, a.ubicacion, CONCAT(p.nombre, ' ', p.apellido) AS nombrePonente
    FROM actividades a
    INNER JOIN ponentes p ON a.id_ponente = p.id
    ORDER BY hora, nombre;
";

$stmt = $conexion->prepare($sql);

if (!$stmt->execute()) {
    $_SESSION['error'] = "No se pudo obtener los datos de las actividades";
}

$resultado = $stmt->get_result();

$actividades = [];
while ($actividad = $resultado->fetch_assoc()) {
    $actividades[] = $actividad;
}
if ($resultado->num_rows > 0): ?>
<?php foreach ($actividades as $actividad): ?>
    <div id="<?php echo $actividad['dia']; ?>" class="content">
        <br><br>
        <div class='table-responsive mx-auto mt-4' style='margin-left:auto; margin-right:auto; max-width:90%; '>
            <table class='table table-striped table-hover'>
                <thead'>
                    <tr>
                        <th scope='col' class='text-center'>Actividad</th>
                        <th scope='col' class='text-center'>Asistentes</th>
                        <th scope='col' class='text-center'>Horario</th>
                        <th scope='col' class='text-center'>Ponente</th>
                    </tr>
                    </thead>
                    
                        <tbody class='table-group-divider '>
                            <tr>
                                <td class='text-center text-sm'>
                                    <p class='openModalBtnCont parti' data-toggle='modal' data-target='#myModalCont<?php echo $actividad['id']; ?>'>
                                        <?php echo $actividad["nombre"]; ?>
                                    </p>    
                                    <br>
                                </td>
                                <td class='text-center'><?php echo $actividad['asistentes']; ?></td>
                                <td class='text-center'><?php echo $actividad['hora']; ?> hrs</td>
                                <td class='text-center'><?php echo $actividad['nombrePonente']; ?></td>
                            </tr>

                            <div class='modal fade' id='myModalCont<?php echo $actividad['id']; ?>' tabindex='-1' role='dialog'
                                aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-body text-center'>
                                            <div class='title-modal'>
                                                <h5><b><?php echo $actividad['nombre']; ?></b></h5>
                                            </div>
                                            <hr>
                                            <h5>Imparte:</h5>
                                            <h5><?php echo $actividad['nombrePonente']; ?></h5>

                                            <h5>Fecha:</h5>
                                            <h5><?php echo $actividad['fecha']; ?></h5>
                                            <h5>Horario:</h5>
                                            <h5><?php echo $actividad['hora']; ?></h5>
                                            <h5>Lugar:</h5>
                                            <h5><?php echo $actividad['ubicacion']; ?></h5>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </tbody>
                        
            </table>
        </div>
    </div>
    <?php endforeach; ?>
<?php else:
    ?>
    <h5>No hay actividades actualmente</h5>

    <?php
endif;
?>