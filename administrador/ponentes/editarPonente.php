<input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
<div class="row">
  <div class="col">
    <div class="form-group row">
      <label for="nombre" class="col-sm-12 col-form-label"><b>Nombre del participante:</b></label>
      <div class="col-sm-12">
        <input type="text" class="form-control" id="nombre" value="<?php echo $fila['nombre']; ?>" name="nombre">
      </div>
    </div>
  </div>

  <div class="col">
    <div class="form-group row">
      <label for="cupo" class="col-sm-12 col-form-label"><b>Apellido:</b></label>
      <div class="col-sm-12">
        <input type="text" class="form-control" id="apellido" value="<?php echo $fila['apellido']; ?>" name="apellido">
      </div>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="descripcion"><b>Descripción del ponente:</b></label>
  <textarea class="form-control" id="descripcion" name="descripcion"><?php echo $fila['descripcion']; ?>
        </textarea>
</div>

<div class="col">
  <div class="form-group">
    <label for="cupo" class="col-sm-12 col-form-label">Rol:</label>
    <div class="input-group mb-3">
      <select class="form-select" id="rol" value="<?php echo $fila['rol']; ?>" name="rol">
        <option value="Conferencista">Conferencista</option>
        <option value="Tallerista">Tallerista interno</option>
        <option value="Tallerista Externo">Tallerista Externo</option>
        <option value="Egresado">Egresado</option>
      </select>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="foto"><b>Fotografía:</b></label>
  <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
</div>

<br>
<button type="submit" class="btn text-white" style="background:#0E773F;" name="guardar">Guardar</button>