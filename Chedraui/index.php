<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "Winsome1";
$database = "chedraui";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Parámetros de paginación
$porPagina = 10; // Número de productos por página
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página actual, predeterminada a 1
$offset = ($paginaActual - 1) * $porPagina;

// Consulta para obtener productos con paginación
$query = "SELECT * FROM producto LIMIT $offset, $porPagina";
$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

$producto = [];

while ($fila = $resultado->fetch_assoc()) {
    $producto[] = $fila;
}

// Consulta para contar el número total de productos
$queryTotal = "SELECT COUNT(*) as total FROM producto";
$resultadoTotal = $conexion->query($queryTotal);

if (!$resultadoTotal) {
    die("Error en la consulta: " . $conexion->error);
}

$totalProductos = $resultadoTotal->fetch_assoc()['total'];

// Calcular el número total de páginas
$totalPaginas = ceil($totalProductos / $porPagina);

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
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
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Catagoria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Promociones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Atencion a Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
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
    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($producto as $producto): ?>
                <div class="col">
                    <div class="card h-100">
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

        <!-- Agrega la paginación -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?php echo ($i == $paginaActual) ? 'active' : ''; ?>">
                        <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
    <script src="chedraui/js/index.js"></script>
    <!-- Agrega el enlace a la biblioteca Font Awesome para el icono del carrito -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Agrega el enlace a los archivos de Bootstrap JS (jQuery y Popper.js son necesarios) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>