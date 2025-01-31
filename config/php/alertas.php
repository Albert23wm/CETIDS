<?php
if (isset($_SESSION['error'])) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '" . $_SESSION['error'] . "',
        });
    </script>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '" . $_SESSION['success'] . "',
        });
    </script>";
    unset($_SESSION['success']);
}

if (isset($_SESSION['warning'])) {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: '¡Espera!',
            text: '" . $_SESSION['warning'] . "',
        });
    </script>";
    unset($_SESSION['warning']);
}
?>
