<?php
include "conexion.php"; // Incluye el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $nombre = $_POST["nombre"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];
    $imagen_url = $_POST["imagen_url"];
    $fechaAgregado = $_POST["fechaAgregado"]; // Obtener la fecha de agregado
    $categoria = $_POST["categoria"]; // Obtener la categoría

    // Consulta para agregar un nuevo producto a la base de datos
    $query = "INSERT INTO producto (nombre, cantidad, precio, imagen_url, fechaagregado, categoria) 
              VALUES ('$nombre', $cantidad, $precio, '$imagen_url', '$fechaAgregado', '$categoria')";

    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        echo "Producto agregado correctamente.";
    } else {
        echo "Error al agregar el producto: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
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

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #FF5A00;
            color: #FFF;
            font-size: 24px;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .btn-primary {
            background-color: #FF5A00;
            color: #FFF;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #FFF;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Agregar Producto</div>
            <div class="card-body">
                <form action="agregarproducto.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="number" name="cantidad" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio:</label>
                        <input type="number" name="precio" step="0.01" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="imagen_url" class="form-label">URL de la imagen:</label>
                        <input type="url" name="imagen_url" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="fechaAgregado" class="form-label">Fecha de Agregado:</label>
                        <input type="date" name="fechaAgregado" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría:</label>
                        <input type="text" name="categoria" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <input type="submit" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <a href="admin.php" class="btn btn-secondary">Volver a la página de Lista de Productos</a>
    </div>
</body>
</html>
