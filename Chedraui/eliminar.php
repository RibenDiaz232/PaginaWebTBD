<?php
require_once('conexion.php');
// Verificar si se estableció una conexión
if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = "DELETE FROM persona WHERE idpersona = $id";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        // Redireccionar al usuario a la página de la tabla de personas
        header('Location: agregar.php');
        exit; // Asegura que la redirección se efectúe
    } else {
        echo "Error al eliminar el usuario: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
