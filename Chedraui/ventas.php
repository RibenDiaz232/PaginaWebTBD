<?php
include "conexion.php"; // Incluye el archivo de conexión

// Verificar si se estableció una conexión
if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}

// Consulta para obtener las opciones de ID de usuario y nombre
$queryUsuarios = "SELECT idusuario, nombre FROM usuario";
$resultadoUsuarios = mysqli_query($conexion, $queryUsuarios);

$idUsuario = isset($_GET['idusuario']) ? $_GET['idusuario'] : null;

if ($idUsuario) {
    // Consultar el nombre del usuario
    $queryNombreUsuario = "SELECT nombre FROM usuario WHERE idusuario = '$idUsuario'";
    $resultadoNombreUsuario = mysqli_query($conexion, $queryNombreUsuario);

    if ($resultadoNombreUsuario && $nombreUsuario = mysqli_fetch_assoc($resultadoNombreUsuario)) {
        $nombreCliente = $nombreUsuario['nombre'];

        // Consulta para obtener las ventas del usuario
        $queryVentasUsuario = "SELECT * FROM ventas WHERE idusuario = '$idUsuario'";
        $resultadoVentasUsuario = mysqli_query($conexion, $queryVentasUsuario);
    } else {
        $nombreCliente = null;
        echo "Error al obtener el nombre del usuario: " . mysqli_error($conexion);
    }
} else {
    $nombreCliente = null;
}

mysqli_close($conexion); // Cierra la conexión
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ventas</title>
    <!-- Incluye la hoja de estilo de Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
    <main class="container">
        <?php if ($nombreCliente): ?>
            <h1 class="text-center">Kardex de Cliente: <?php echo $nombreCliente; ?></h1>

            <!-- Si se proporcionó el ID de usuario, mostrar las ventas -->
            <?php if ($resultadoVentasUsuario && mysqli_num_rows($resultadoVentasUsuario) > 0): ?>
                <?php while ($venta = mysqli_fetch_assoc($resultadoVentasUsuario)): ?>
                    <h2 class="text-center">Fecha de Compra: <?php echo $venta['fecha']; ?></h2>

                    <!-- Tabla con nuevo diseño -->
                    <table class="table table-sm table-info">
                        <thead>
                            <tr>
                                <th scope="col">Producto</th>
                                <th scope="col">Precio Unitario</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio total del producto </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $venta['producto']; ?></td>
                                <td>$<?php echo $venta['precio']; ?></td>
                                <td><?php echo $venta['cantidad']; ?></td>
                                <td>$<?php echo $venta['total']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No hay registros de ventas para este usuario.</p>
            <?php endif; ?>
        <?php else: ?>
            <p class="text-center">Selecciona un usuario para ver su Kardex.</p>
        <?php endif; ?>

        <!-- Botón para abrir la ventana modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventanaKardex">
            Lista de Ventas
        </button>

        <!-- Ventana modal para el formulario de búsqueda -->
        <div class="modal fade" id="ventanaKardex" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buscar Kardex de Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="get" action="ventas.php">
                            <!-- Campo para seleccionar ID de Usuario -->
                            <div class="mb-3">
                                <label for="idusuario" class="form-label">Nombre de Usuario:</label>
                                <select class="form-select" name="idusuario" required>
                                    <option selected disabled>Seleccione Nombre de Usuario</option>
                                    <?php while ($usuario = mysqli_fetch_assoc($resultadoUsuarios)): ?>
                                        <option value="<?php echo $usuario['idusuario']; ?>">
                                            <?php echo isset($usuario['nombre']) ? $usuario['nombre'] : ''; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Buscar Kardex</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts de Bootstrap 5 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </main>
</body>

</html>
