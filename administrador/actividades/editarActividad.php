<input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
<div class="mb-3">
    <label for="dia" class="form-label">Día</label>
    <select class="form-select" name="dia" id="dia" required>
        <option value="<?php echo $fila['dia']; ?>" selected disabled>Día <?php echo $fila['dia']; ?></option>
        <option value="1">Día 1</option>
        <option value="2">Día 2</option>
        <option value="3">Día 3</option>
    </select>
</div>

<div class="mb-3">
    <label for="nombre" class="form-label">Nombre de la actividad</label>
    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la actividad"
        value="<?php echo $fila['nombre'] ?>" required>
</div>

<div class="mb-3">
    <label for="asistentes" class="form-label">Asistentes, ej: 2º y 8º</label>
    <input type="text" name="asistentes" id="asistentes" class="form-control" placeholder="Asistentes, ej: 1º y 4º"
        value="<?php echo $fila['asistentes']; ?>" required>
</div>

<div class="mb-3">
    <label for="fecha" class="form-label">Fecha</label>
    <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $fila['fecha']; ?>" required>
</div>

<div class="mb-3">
    <label for="hora_actividad" class="form-label">Hora de la actividad</label>
    <input type="text" name="hora" id="hora" class="form-control" placeholder="Hora de la actividad, ej: 9:00 hrs."
        value="<?php echo $fila['hora']; ?>" required>
</div>

<div class="mb-3">
    <label for="lugar" class="form-label">Lugar de la actividad</label>
    <input type="text" name="lugar" id="lugar" class="form-control" placeholder="Lugar de la actividad"
        value="<?php echo $fila['ubicacion']; ?>" required>
</div>

<div class="mb-3">
    <label for="PonCord" class="form-label">Ponente</label>
    <select class="form-select" name="ponente" id="ponente" required>
        <option value="" selected disabled>Elige al ponente</option>
        <?php
        $query = "SELECT id, CONCAT(nombre, ' ', apellido) AS nombreCompleto FROM ponentes";

        $results = mysqli_query($conexion, $query);

        if ($results->num_rows > 0) {
            while ($datosPonente = $results->fetch_assoc()) {
                echo "<option value='" . $datosPonente['id'] . "' name='ponente'>" . $datosPonente['nombreCompleto'] . "</option>";
            }
        } else {
            echo "<p>No hay ponentes en el sistema</p>";
        }
        ?>
    </select>
</div>

<button type="submit" class="btn text-white" style="background:#611232;" value="actualizar" name="confirmar">
    Guardar cambios
</button>