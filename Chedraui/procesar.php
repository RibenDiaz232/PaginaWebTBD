<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $puesto = $_POST['puesto'];

    // Realizar la inserción de datos del usuario en la base de datos o realizar alguna acción

    if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['cantidad'])) {
        $nombre_producto = $_POST['nombre_producto'];
        $precio_producto = $_POST['precio_producto'];
        $cantidad_producto = $_POST['cantidad_producto'];

        // Realizar la inserción de datos del producto en la base de datos o realizar alguna acción
    }

    // Redirigir a la página de inicio u otra página según sea necesario
    header('Location: conexion.php');
    exit; // Asegura que la redirección se efectúe
}
?>
