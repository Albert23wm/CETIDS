<?php 

$query = "SELECT * FROM convocatorias";
$result = mysqli_query($conexion, $query);

$convocatorias = [];
while($convocatoria = $result->fetch_assoc()){
    $convocatorias[] = $convocatoria;
}
if($result->num_rows > 0):
foreach($convocatorias as $convocatoria):
?>

<div class='card'>
    <div class='image'>
        <img src='<?php echo $convocatoria['ruta_imagen']; ?>' alt='Imagen 1'>
    </div>
    <h2><?php echo $convocatoria['nombre']; ?></h2>
    <a class='btn btn-success' data-toggle='modal' data-target='#mostrarArchivoModals<?php echo $convocatoria['id']; ?>'>
        Ver convocatoria
    </a>
</div>

<div class='modal' id='mostrarArchivoModals<?php echo $convocatoria['id']; ?>' tabindex='-1' role='dialog'
    aria-labelledby='mostrarArchivoModalLabel<?php echo $convocatoria['id']; ?>' aria-hidden='true'>
    <div class='modal-content-pro'>
        <div class='modal-body'>
            <embed src='<?php echo $convocatoria['ruta_documento']; ?>' type='application/pdf'
                width='100%' height='500px' />
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>
        </div>
    </div>
</div>
<?php 
endforeach;
else:
?>
<h4 style="margin-top: 30px;">No hay convocatorias actualmente publicadas</h4>
<?php 
endif;
?>