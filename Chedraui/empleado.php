<?php
include("conexion.php");

// Verificar si se estableció una conexión
if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}

// Consulta para obtener los productos
$query = "SELECT * FROM producto"; // Puedes ajustar la consulta según tus necesidades

// Realizar la consulta
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Inicializar el array de productos
$producto = [];

// Obtener los resultados de la consulta
while ($fila = mysqli_fetch_assoc($resultado)) {
    $producto[] = $fila;
}

// Cerrar la conexión
mysqli_close($conexion);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos Nuevos</title>
    <!-- Agrega el enlace a los archivos de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Mueve el logotipo a la derecha utilizando ml-auto -->
            <img src="/chedraui/img/oxxo-gaming.png" alt="logo" width="150px" class="ml-auto">
            <!-- Botón de hamburguesa para dispositivos móviles -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Caja De Cobro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Promociones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Servicios</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Iniciar Sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="carrito.php">
                        <i class="fas fa-shopping-cart"></i> Carrito
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
        <?php foreach ($producto as $producto): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?php echo $producto['imagen_url']; ?>" class="card-img-top" alt="<?php echo $producto['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
                        <p class="card-text"><?php echo $producto['descripcion']; ?></p>
                        <p class="card-text">$<?php echo $producto['precio']; ?></p>
                        
                        <!-- Modifica el formulario para agregar al carrito -->
                        <form method="GET" action="carrito.php">
                            <input type="hidden" name="agregar" value="<?php echo $producto['idProducto']; ?>">
                            <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>

    <script src="chedraui/js/index.js"></script>
    <!-- Agrega el enlace a la biblioteca Font Awesome para el icono del carrito -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Agrega el enlace a los archivos de Bootstrap JS (jQuery y Popper.js son necesarios) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
