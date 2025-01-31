<?php
$idTaller = $fila['id'];

$query = "SELECT CONCAT(p.nombre, ' ', p.apellido) AS nombrePonente FROM talleres t
        INNER JOIN ponentes p ON t.id_ponente = p.id;
    ";

$result = mysqli_query($conexion, $query);
$datos = mysqli_fetch_assoc($result);

// Datos del taller 
$nombre = $fila['nombre'];
$cupo = $fila['cupo'];
$ponente = $datos['nombrePonente'];
$cuatrimestre = $fila['cuatrimestre'];

$descripcion = $fila['descripcion'];

?>
<input type="hidden" name="id" value="<?php echo $idTaller; ?>">
<div class="row">
    <div>
        <div class="form-group row">
            <label for="nombre" class="col-sm-12 col-form-label">Nombre del taller:</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" id="nombre" value="<?php echo $nombre; ?>" name="nombre">
            </div>
        </div>
    </div>

    <div class="col">
        <div class="form-group row">
            <label for="cupo" class="col-sm-12 col-form-label">Cupo límite:</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" id="cupo" value="<?php echo $cupo; ?>" name="cupo" required>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group row">
            <label for="cuatrimestre" class="col-sm-12 col-form-label">cuatrimestre:</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" id="cuatrimestre" value="<?php echo $cuatrimestre; ?>" name="cuatrimestre" required>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="ponente">Ponente:</label>
    <select class="form-select" name="ponente" required>
        <?php
        include("../../config/php/conexion.php");


        // Consulta SQL para obtener los nombres completos de los ponentes (nombre y apellido combinados)
        $sql = "SELECT id, CONCAT(nombre, ' ', apellido) AS nombreCompleto FROM ponentes";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            // Generar opciones basadas en los resultados de la consulta
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["id"] . '">' . $row["nombreCompleto"] . '</option>';
            }
        }

        ?>
    </select>
</div>

<div class="form-group row">
    <label for="descripcion" class="col-sm-12 col-form-label">Descripción del taller</label>
    <div class="col-sm-12">
        <textarea class="form-control" id="descripcion" name="descripcion"
            rows="4" required><?php echo $descripcion; ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="imagen_curso" class="col-sm-12 col-form-label">Imagen del taller:</label>
    <div class="col-sm-12">
        <input type="file" class="form-control" name="imagenTaller" id="imagenTaller" accept="image/*">
    </div>
</div>
<br>

<button type="submit" class="btn text-white" style="background:#0E773F;" name="enviar">Guardar cambios</button>
