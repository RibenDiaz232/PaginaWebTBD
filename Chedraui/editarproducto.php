<?php
include "conexion.php"; // Incluye el archivo de conexión a la base de datos

// Verificar si se estableció una conexión
if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}


// Verificar si se ha enviado un ID de producto válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idProducto = $_GET['id'];
    
    // Consulta para obtener los detalles del producto
    $query = "SELECT * FROM producto WHERE idProducto = $idProducto";
    $resultado = mysqli_query($conexion, $query);
    
    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }
    
    $producto = mysqli_fetch_assoc($resultado);
    
    // Procesar el formulario de edición
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $precio = $_POST['precio'];
        $fechaAgregado = $_POST['fechaAgregado']; // Agregar campo para la fecha
        $imagen = $_POST['imagen_url']; // URL de la imagen
        
        // Actualizar los datos del producto, incluyendo fecha y URL de la imagen
        $query = "UPDATE producto SET nombre = '$nombre', cantidad = $cantidad, precio = $precio, fechaagregado = '$fechaAgregado', imagen_url = '$imagen' WHERE idProducto = $idProducto";
        
        if (mysqli_query($conexion, $query)) {
            echo "Producto actualizado correctamente.";
        } else {
            echo "Error al actualizar el producto: " . mysqli_error($conexion);
        }
    }
} else {
    echo "ID de producto no válido.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <!-- Incluye la hoja de estilo de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f9f9f9;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
        }

        .table th,
        .table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .table th {
            background-color: #eee;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .img-thumbnail {
            max-width: 150px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Producto</h1>
        <form method="POST">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">Nombre del Producto</th>
                        <td>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $producto['nombre']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Cantidad</th>
                        <td>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" value="<?php echo $producto['cantidad']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Precio</th>
                        <td>
                            <input type="text" name="precio" id="precio" class="form-control" value="<?php echo $producto['precio']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Fecha de Agregación</th>
                        <td>
                            <input type="date" name="fechaAgregado" id="fechaAgregado" class="form-control" value="<?php echo $producto['fechaagregado']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">URL de la Imagen del Producto</th>
                        <td>
                            <input type="url" name="imagen_url" id="imagen_url" class="form-control" value="<?php echo $producto['imagen_url']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Imagen Actual del Producto</th>
                        <td>
                            <?php
                            // Mostrar la imagen actual del producto
                            $imagen = $producto['imagen_url'];
                            if (!empty($imagen)) {
                                echo "<img src='$imagen' alt='{$producto['nombre']}' width='150' class='img-thumbnail'>";
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mb-3">
                <input type="submit" value="Actualizar Producto" class="btn btn-primary">
            </div>
        </form>
        <a href="admin.php" class="btn btn-secondary">Volver a la lista
