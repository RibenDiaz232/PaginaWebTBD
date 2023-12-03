<?php
session_start();

include_once 'conexion.php';

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $menuUsuario = "<li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            $usuario
                        </a>
                        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                            <a class='dropdown-item' href='perfil.php'>Editar Perfil</a>
                            <a class='dropdown-item' href='mis_compras.php'>Mis Compras</a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item' href='cerrar_sesion.php'>Cerrar Sesión</a>
                        </div>
                    </li>";
} else {
    $menuUsuario = "<li class='nav-item'>
                        <a class='nav-link' href='login.php'>Iniciar Sesión</a>
                    </li>";
}

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $botonIniciarSesion = "<li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                $usuario
                            </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' href='perfil.php'>Ver Perfil</a>
                                <div class='dropdown-divider'></div>
                                <a class='dropdown-item' href='logout.php'>Cerrar Sesión</a>
                            </div>
                          </li>";
} else {
    $botonIniciarSesion = "<li class='nav-item'>
                            <a class='nav-link' href='login.php'>Iniciar Sesión</a>
                          </li>";
}

if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}

$porPagina = 10;
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $porPagina;

$queryCategorias = "SELECT DISTINCT categoria FROM producto";
$resultadoCategorias = $conexion->query($queryCategorias);

if (!$resultadoCategorias) {
    die("Error en la consulta de categorías: " . $conexion->error);
}

$categorias = [];

while ($filaCategoria = $resultadoCategorias->fetch_assoc()) {
    $categorias[] = $filaCategoria['categoria'];
}

$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';

$query = "SELECT * FROM producto";
if ($categoriaSeleccionada) {
    $query .= " WHERE categoria = '$categoriaSeleccionada'";
}
$query .= " LIMIT $offset, $porPagina";

$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

$producto = [];

while ($fila = $resultado->fetch_assoc()) {
    $producto[] = $fila;
}

$queryTotal = "SELECT COUNT(*) as total FROM producto";
if ($categoriaSeleccionada) {
    $queryTotal .= " WHERE categoria = '$categoriaSeleccionada'";
}

$resultadoTotal = $conexion->query($queryTotal);

if (!$resultadoTotal) {
    die("Error en la consulta: " . $conexion->error);
}

$totalProductos = $resultadoTotal->fetch_assoc()['total'];

$totalPaginas = ceil($totalProductos / $porPagina);

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Tu Tienda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Categoría</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Promociones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ventas.php">Ventas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Atención a Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Perfil</a>
                </li>
            </ul>
        </div>
        <form method="GET" action="index.php" class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar categoría" aria-label="Search" name="categoria">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
        <ul class="navbar-nav ml-auto">
            <?php echo $botonIniciarSesion; ?>
            <li class="nav-item">
                <a class="nav-link" href="carrito.php">
                    <i class="fas fa-shopping-cart"></i> Carrito
                </a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($producto as $producto): ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?php echo $producto['imagen_url']; ?>" class="card-img-top" alt="<?php echo $producto['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
                        <p class="card-text"><?php echo $producto['descripcion']; ?></p>
                        <p class="card-text">$<?php echo $producto['precio']; ?></p>
                        <form method="GET" action="carrito.php">
                            <input type="hidden" name="agregar" value="<?php echo $producto['idProducto']; ?>">
                            <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?php echo ($i == $paginaActual) ? 'active' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $i . ($categoriaSeleccionada ? '&categoria=' . $categoriaSeleccionada : ''); ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>