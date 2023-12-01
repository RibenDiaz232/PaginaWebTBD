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

// Consulta para obtener las opciones de ID de usuario
$queryUsuarios = "SELECT idusuario FROM usuario";
$resultadoUsuarios = mysqli_query($conexion, $queryUsuarios);

// Consulta para obtener las opciones de productos
$queryProductos = "SELECT nombre FROM producto";
$resultadoProductos = mysqli_query($conexion, $queryProductos);

mysqli_close($conexion); // Cierra la conexión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Ventas</title>
    <!-- Incluye la hoja de estilo de Bootstrap 5 -->
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

    <!-- Botón para abrir la ventana modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaVenta">
        Añadir venta
    </button>

    <!-- Ventana modal para el formulario de venta -->
    <div class="modal fade" id="ventanaVenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <!-- Campo para seleccionar ID de Usuario -->
                        <div class="mb-3">
                            <label for="id_usuario" class="form-label">ID Usuario:</label>
                            <select class="form-select" name="id_usuario" required>
                                <option selected disabled>Seleccione ID de Usuario</option>
                                <?php while ($usuario = mysqli_fetch_assoc($resultadoUsuarios)): ?>
                                    <option value="<?php echo $usuario['idusuario']; ?>"><?php echo $usuario['idusuario']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- Campo para seleccionar Producto -->
                        <div class="mb-3">
                            <label for="producto" class="form-label">Producto:</label>
                            <select class="form-select" name="producto" required>
                                <option selected disabled>Seleccione Producto</option>
                                <?php while ($producto = mysqli_fetch_assoc($resultadoProductos)): ?>
                                    <option value="<?php echo $producto['nombre']; ?>"><?php echo $producto['nombre']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- Campo para ingresar Cantidad -->
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad:</label>
                            <input type="number" class="form-control" name="cantidad" required>
                        </div>

                        <!-- Campo para ingresar Precio Unitario -->
                        <div class="mb-3">
                            <label for="precio_unitario" class="form-label">Precio Unitario:</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" name="precio_unitario" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar Venta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered mt-4">
        <thead class="table-primary">
        <tr>
            
            <th scope="col">ID Usuario</th>
            <th scope="col">Fecha</th>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio Unitario</th>
            <th scope="col">Total</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($venta = mysqli_fetch_assoc($resultado)): ?>
            <tr>                
                <td><?php echo $IDUsuario['idusuario']; ?></td>
                <td><?php echo $fechaCompra['fecha']; ?></td>
                <td><?php echo $producto['producto']; ?></td>
                <td><?php echo $cantidad['cantidad']; ?></td>
                <td>$<?php echo $precioUnitario['precio']; ?></td>
                <td>$<?php echo $total['total']; ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</main>

<!-- Scripts de Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
