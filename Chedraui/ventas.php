<?php
include "conexion.php"; // Incluye el archivo de conexión

// Consulta todos los registros de ventas
$query = "SELECT * FROM ventas";
$resultado = mysqli_query($conexion, $query);

$compraExitosa = isset($_GET['compra_exitosa']) && $_GET['compra_exitosa'] == '1';

mysqli_close($conexion); // Cierra la conexión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Ventas</title>
    <!-- Incluye la hoja de estilo de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<main class="container">
    <h1 class="text-center">Registro de Ventas</h1>
    
    <?php if ($compraExitosa): ?>
        <div class="alert alert-success" role="alert">
            ¡La compra se ha realizado con éxito!
        </div>
    <?php endif; ?>
    
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($venta = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $venta['id']; ?></td>
                <td><?php echo $venta['fecha']; ?></td>
                <td><?php echo $venta['producto']; ?></td>
                <td><?php echo $venta['cantidad']; ?></td>
                <td>$<?php echo $venta['precio']; ?></td>
                <td>$<?php echo $venta['total']; ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</main>
</body>
</html>
