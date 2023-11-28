<?php
include "conexion.php"; // Incluye el archivo de conexión a la base de datos

// Consulta para obtener la lista de productos
$query = "SELECT * FROM producto";
$resultado = mysqli_query($conexion, $query);
$productos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <!-- Incluye la hoja de estilo de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Productos</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($productos as $producto): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo $producto['imagen_url']; ?>" alt="<?php echo $producto['nombre']; ?>" class="card-img-top" style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
                            <p class="card-text">Cantidad: <?php echo $producto['cantidad']; ?></p>
                            <p class="card-text">$<?php echo $producto['precio']; ?></p>
                        </div>
                        <div class="card-footer">
                            <!-- Botón de Editar -->
                            <a href="editarproducto.php?id=<?php echo $producto['idProducto']; ?>" class="btn btn-primary">Editar</a>
                            
                            <!-- Botón de Eliminar -->
                            <a href="eliminarproducto.php?id=<?php echo $producto['idProducto']; ?>" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <!-- Botón para Agregar Producto -->
            <a href="agregarproducto.php" class="btn btn-success mr-3">Agregar Producto</a>

            <!-- Botón para Regresar al Index -->
            <a href="admin.php" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <!-- Incluye los archivos de JavaScript de Bootstrap (jQuery y Popper.js son necesarios) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
