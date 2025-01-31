function validateFile(input) {
    const allowedExtensions = input.accept.split(',').map(ext => ext.trim());
    const maxFileSizeInMB = 3;

    const file = input.files[0];

    if (file) {
        const fileSizeInMB = file.size / (1024 * 1024); // Convertir el tamaño a megabytes

        // Verificar la extensión del archivo
        const fileExtension = file.name.split('.').pop();
        if (!allowedExtensions.includes('.' + fileExtension)) {
            alert('Error: Tipo de archivo no permitido. Por favor, seleccione un archivo con la extensión permitida.');
            input.value = ''; // Limpiar el valor del campo de entrada
            return;
        }

        // Verificar el tamaño del archivo
        if (fileSizeInMB > maxFileSizeInMB) {
            alert(`Error: El tamaño del archivo supera el límite permitido (${maxFileSizeInMB} MB). Por favor, seleccione un archivo más pequeño.`);
            input.value = ''; // Limpiar el valor del campo de entrada
        }
    }
}