<?php
include "conexion.php"; // Incluye el archivo de conexión

// Verificar si se estableció una conexión
if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}

$compraExitosa = isset($_GET['compra_exitosa']) && $_GET['compra_exitosa'] == '1';

// Eliminar compra si se proporciona un ID
if (isset($_GET['eliminar_id'])) {
    $idEliminar = $_GET['eliminar_id'];
    $queryEliminar = "DELETE FROM ventas WHERE idVenta = '$idEliminar'";
    $resultadoEliminar = mysqli_query($conexion, $queryEliminar);
    if ($resultadoEliminar) {
        header("Location: ventas.php");
        exit();
    } else {
        echo "Error al eliminar la compra: " . mysqli_error($conexion);
    }
}

// Si se envía un formulario de compra
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $idUsuario = $_POST['idusuario'];
    $fechaCompra = date("Y-m-d H:i:s"); // Fecha actual
    $producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];

    // Consultar el precio unitario del producto desde la base de datos
    $queryPrecioProducto = "SELECT precio FROM producto WHERE nombre = '$producto'";
    $resultadoPrecioProducto = mysqli_query($conexion, $queryPrecioProducto);

    if ($resultadoPrecioProducto) {
        $filaPrecioProducto = mysqli_fetch_assoc($resultadoPrecioProducto);
        $precioProducto = $filaPrecioProducto['precio'];

        // Calcular el total
        $total = $cantidad * $precioProducto;

        // Insertar la venta en la base de datos
        $queryInsert = "INSERT INTO ventas (idusuario, fecha, producto, cantidad, precio, total) 
                        VALUES ('$idUsuario', '$fechaCompra', '$producto', '$cantidad', '$precioProducto', '$total')";

        $resultadoInsert = mysqli_query($conexion, $queryInsert);

        if ($resultadoInsert) {
            // Redirigir con mensaje de compra exitosa
            header("Location: ventas.php?compra_exitosa=1");
            exit();
        } else {
            echo "Error al registrar la venta: " . mysqli_error($conexion);
        }
    } else {
        echo "Error al obtener el precio del producto: " . mysqli_error($conexion);
    }
}

// Consulta todos los registros de ventas
$query = "SELECT * FROM ventas";
$resultado = mysqli_query($conexion, $query);

// Consulta para obtener las opciones de ID de usuario
$queryUsuarios = "SELECT idusuario FROM usuario";
$resultadoUsuarios = mysqli_query($conexion, $queryUsuarios);

// Consulta para obtener las opciones de productos
$queryProductos = "SELECT nombre, precio FROM producto";
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

        <div class="d-flex justify-content-between mb-3">
            <!-- Botón para abrir la ventana modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaVenta">
                Añadir venta
            </button>

            <!-- Botón para salir -->
            <a href="admin.php" class="btn btn-danger">Salir</a>
        </div>

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
                                <label for="idusuario" class="form-label">ID Usuario:</label>
                                <select class="form-select" name="idusuario" required>
                                    <option selected disabled>Seleccione ID de Usuario</option>
                                    <?php while ($usuario = mysqli_fetch_assoc($resultadoUsuarios)): ?>
                                        <option value="<?php echo $usuario['idusuario']; ?>">
                                            <?php echo isset($usuario['idusuario']) ? $usuario['idusuario'] : ''; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <!-- Campo para seleccionar Producto -->
                            <div class="mb-3">
                                <label for="producto" class="form-label">Producto:</label>
                                <select class="form-select" name="producto" required>
                                    <option selected disabled>Seleccione Producto</option>
                                    <?php while ($producto = mysqli_fetch_assoc($resultadoProductos)): ?>
                                        <option value="<?php echo $producto['nombre']; ?>">
                                            <?php echo isset($producto['nombre']) ? $producto['nombre'] : ''; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <!-- Campo para ingresar Cantidad -->
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input type="number" class="form-control" name="cantidad" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Registrar Venta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla con nuevo diseño -->
        <table class="table table-sm table-info">
            <thead>
                <tr>
                    <th scope="col">ID Usuario</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">Total</th>
                    <th scope="col">Eliminar compra / PDF</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($venta = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td>
                            <?php echo isset($venta['idusuario']) ? $venta['idusuario'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($venta['fecha']) ? $venta['fecha'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($venta['producto']) ? $venta['producto'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($venta['cantidad']) ? $venta['cantidad'] : ''; ?>
                        </td>
                        <td>
                            $<?php echo isset($venta['precio']) ? $venta['precio'] : ''; ?>
                        </td>
                        <td>
                            $<?php echo isset($venta['total']) ? $venta['total'] : ''; ?>
                        </td>
                        <td>
                            <!-- Botón para eliminar compra -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#confirmarEliminar<?php echo $venta['idVenta']; ?>">
                                Eliminar
                            </button>

                            <!-- Modal de confirmación -->
                            <div class="modal fade" id="confirmarEliminar<?php echo $venta['idVenta']; ?>" tabindex="-1"
                                aria-labelledby="confirmarEliminarLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmarEliminarLabel"> Confirmar Eliminación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estás seguro de que deseas eliminar esta compra?
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Botón para cancelar -->
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Cancelar</button>

                                            <!-- Botón para aceptar (eliminar) -->
                                            <a href="ventas.php?eliminar_id=<?php echo $venta['idVenta']; ?>"
                                                class="btn btn-success">Aceptar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <!-- Scripts de Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
