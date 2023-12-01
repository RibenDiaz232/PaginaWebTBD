<?php
include "conexion.php"; // Incluye el archivo de conexión

// Verificar si se estableció una conexión
if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}

$compraExitosa = isset($_GET['compra_exitosa']) && $_GET['compra_exitosa'] == '1';

// Si se envía un formulario de compra
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $idUsuario = $_POST['id_usuario'];
    $fechaCompra = date("Y-m-d H:i:s"); // Fecha actual
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $precioUnitario = $_POST['precio_unitario'];

    // Calcular el total
    $total = $cantidad * $precioUnitario;

    // Insertar la venta en la base de datos
    $queryInsert = "INSERT INTO ventas (id_usuario, fecha, producto, cantidad, precio, total) 
                    VALUES ('$idUsuario', '$fechaCompra', '$producto', '$cantidad', '$precioUnitario', '$total')";
    
    $resultadoInsert = mysqli_query($conexion, $queryInsert);

    if ($resultadoInsert) {
        // Redirigir con mensaje de compra exitosa
        header("Location: registro_ventas.php?compra_exitosa=1");
        exit();
    } else {
        echo "Error al registrar la venta: " . mysqli_error($conexion);
    }
}

// Consulta todos los registros de ventas
$query = "SELECT * FROM ventas";
$resultado = mysqli_query($conexion, $query);

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

    <form method="post">
        <!-- Agrega campos del formulario para la venta -->
        <label for="id_usuario">ID Usuario:</label>
        <input type="text" name="id_usuario" required>

        <label for="producto">Producto:</label>
        <input type="text" name="producto" required>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" required>

        <label for="precio_unitario">Precio Unitario:</label>
        <input type="text" name="precio_unitario" required>

        <button type="submit">Registrar Venta</button>
    </form>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>ID Usuario</th>
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
                <td><?php echo $venta['id_usuario']; ?></td>
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
