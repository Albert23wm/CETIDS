<?php 

$query = "SELECT id, CONCAT(nombre, ' ', apellido) AS nombreCompleto, descripcion, rol, url_foto FROM ponentes WHERE rol LIKE 'Tallerista%'";
$result = mysqli_query($conexion, $query);

$ponentes = [];
while($ponente = $result->fetch_assoc()){
    $ponentes[] = $ponente;
}
if($result->num_rows > 0):
foreach($ponentes as $ponente):
?>
<div class='card' style='width: 18rem; border-radius: 0; box-shadow: none;'>
    <a data-toggle='modal' data-target='#mostrarArchivoModal<?php echo $ponente['id']; ?>'>
        <img class='card-img-top' src='<?php echo $ponente['url_foto']; ?>' alt='Imagen 1'
            style='width: 100%; height: 300px; object-fit: cover;'>
        <div class='card-body'>

            <h5 class='card-title parti'><?php echo $ponente['nombreCompleto']; ?></h5>
            <p class='card-text' style='text-align:justify;'>
                <!-- Contenido del card, puedes modificarlo según tus necesidades -->
            </p>
        </div>
    </a>
</div>
<div class='modal fade' id='mostrarArchivoModal<?php echo $ponente['id']; ?>' tabindex='-1'
    aria-labelledby='mostrarArchivoModalLabel<?php echo $ponente['id']; ?>' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>

                <i class='bx bx-x close' style='color: #959191; font-size: 30px;' data-dismiss='modal'
                    aria-label='Close'></i>
            </div>

            <div class='modal-body'>
                <div class='image'>
                    <img src='<?php echo $ponente['url_foto']; ?>' style='height: 350px; width: 350px;'>
                </div>
                <h2 class='modal-title text-center'><b><?php echo $ponente['nombreCompleto']; ?></b></h2>
                <hr class='my-4'>
                <p style='text-align:justify; '><?php echo $ponente['descripcion']; ?></p>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>

            </div>
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