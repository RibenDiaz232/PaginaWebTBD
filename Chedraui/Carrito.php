<?php
session_start();

// Inicializa el carrito en la sesión si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar producto al carrito
if (isset($_GET['agregar'])) {
    $productoId = $_GET['agregar'];

    // Verifica si el producto ya está en el carrito
    if (array_key_exists($productoId, $_SESSION['carrito'])) {
        $_SESSION['carrito'][$productoId]['cantidad'] += 1; // Incrementa la cantidad si ya existe
    } else {
        // Si el producto no está en el carrito, obtén su información de la base de datos
        // y agrega un nuevo elemento al carrito
        // Asume que tienes una tabla "productos" en tu base de datos
        include "conexion.php"; // Incluye el archivo de conexión

        $query = "SELECT * FROM producto WHERE idProducto = $productoId";
        $resultado = mysqli_query($conexion, $query);

        if ($producto = mysqli_fetch_assoc($resultado)) {
            $_SESSION['carrito'][$productoId] = [
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1
            ];
        }

        mysqli_close($conexion); // Cierra la conexión
    }
}

// Modificar la cantidad de un producto en el carrito
if (isset($_POST['actualizar'])) {
    foreach ($_POST['cantidad'] as $productoId => $cantidad) {
        if ($cantidad <= 0) {
            // Si la cantidad es 0 o menos, elimina el producto del carrito
            unset($_SESSION['carrito'][$productoId]);
        } else {
            // Actualiza la cantidad del producto en el carrito
            $_SESSION['carrito'][$productoId]['cantidad'] = $cantidad;
        }
    }
}

// Eliminar producto del carrito
if (isset($_GET['eliminar'])) {
    $productoId = $_GET['eliminar'];
    if (isset($_SESSION['carrito'][$productoId])) {
        unset($_SESSION['carrito'][$productoId]);
    }
}

// Cerrar la sesión
// session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <!-- Incluye la hoja de estilo de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        /* Estilo para la animación de procesando compra */
        .procesando-container {
            display: none;
            flex-direction: column;
            align-items: center;
            font-size: 24px;
            text-align: center;
        }

        .carrito {
            font-size: 36px;
            margin-bottom: 20px;
            animation: moverCarrito 2s linear infinite;
        }

        @keyframes moverCarrito {
            0% { transform: translateX(0); }
            50% { transform: translateX(50px); }
            100% { transform: translateX(0); }
        }
    </style>
</head>
<body>
<main class="container">
    <h1 class="text-center">Carrito de Compras</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Eliminar</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($_SESSION['carrito'] as $productoId => $producto): ?>
            <tr>
                <td><?php echo $producto['nombre']; ?></td>
                <td>$<?php echo $producto['precio']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="actualizar[<?php echo $productoId; ?>]" value="1">
                        <input type="number" name="cantidad[<?php echo $productoId; ?>]"
                               value="<?php echo $producto['cantidad']; ?>" min="1" class="form-control">
                        <input type="submit" value="Actualizar" class="btn btn-primary">
                    </form>
                </td>
                <td>$<?php echo $producto['cantidad'] * $producto['precio']; ?></td>
                <td>
                    <a href="?eliminar=<?php echo $productoId; ?>" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="text-center">Total del Carrito: $<?php
        $totalCarrito = 0;
        foreach ($_SESSION['carrito'] as $productoId => $producto) {
            $totalCarrito += $producto['cantidad'] * $producto['precio'];
        }
        echo $totalCarrito;
        ?></h2>

    <div class="d-flex justify-content-center">
        <button type="button" name="comprar" onclick="procesarCompra()" class="btn btn-success">Comprar</button>
        <form method="post" class="mx-1">
            <button type="submit" name="volver" class="btn btn-outline-secondary">
                <a href="cliente.php" style="text-decoration: none; color: inherit;">Volver</a>
            </button>
        </form>
    </div>

    <!-- Elemento para mostrar la animación de "Procesando Compra" -->
    <div id="animacionProceso" class="procesando-container">
        <div class="carrito">&#128722;</div>
        Procesando Compra...
    </div>
</main>

<script>
    function procesarCompra() {
        // Oculta el botón de "Comprar"
        document.querySelector('[name="comprar"]').style.display = 'none';

        // Muestra la animación de "Procesando Compra"
        document.getElementById('animacionProceso').style.display = 'flex';

        // Simula una demora de 5 segundos (5000 milisegundos) antes de mostrar "Compra Exitosa"
        setTimeout(function () {
            // Oculta la animación de "Procesando Compra"
            document.getElementById('animacionProceso').style.display = 'none';

            // Muestra "Compra Exitosa"
            alert("Compra exitosa");

            // Después de mostrar "Compra Exitosa"
            location.reload(); // Recarga la página para ejecutar la lógica de guardar las ventas
        }, 5000); // 5000 milisegundos (5 segundos)
    }
</script>
</body>
</html>
