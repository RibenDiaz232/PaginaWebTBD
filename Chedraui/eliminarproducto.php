<?php
include "conexion.php"; // Incluye el archivo de conexión a la base de datos

if (isset($_GET['id'])) {
    $idProducto = $_GET['id'];
    
    // Consulta para eliminar el producto por su ID
    $query = "DELETE FROM producto WHERE idProducto = $idProducto";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        echo "Producto eliminado correctamente.";
    } else {
        echo "Error al eliminar el producto.";
    }
} else {
    echo "ID de producto no proporcionado.";
}

// Redirige de nuevo a la página principal
header("Location: admin.php"); // Cambia "index.php" por el nombre de tu archivo principal si es diferente
?>
