<?php
session_start();

include_once 'conexion.php';

// Verificar si se estableció una conexión
if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}

// Obtén la información del usuario desde la base de datos
$idusuario = isset($_SESSION['idusuario']) ? $_SESSION['idusuario'] : null;

if ($idusuario) {
    // Realiza la consulta a tu base de datos para obtener los datos del usuario
    $queryUsuario = "SELECT * FROM usuario WHERE idusuario = $idusuario";
    $resultadoUsuario = $conexion->query($queryUsuario);

    if (!$resultadoUsuario) {
        die("Error en la consulta de usuario: " . $conexion->error);
    }

    $usuario = $resultadoUsuario->fetch_assoc();

    // Cierra la conexión después de obtener la información del usuario
    $conexion->close();
} else {
    // No hay un usuario iniciado, puedes manejar esto según tus necesidades
    // Por ahora, permitir que la página cargue normalmente
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
// Mostrar enlace de registro si el usuario no ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    $enlaceRegistro = "<li class='nav-item'>
                          <a class='nav-link' href='registro.php'>Registrarse</a>
                      </li>";
} else {
    $enlaceRegistro = "";  // No mostrar enlace de registro si el usuario ha iniciado sesión
}

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
        <a class="navbar-brand" href="#">
            <img src="../Chedraui/img/CHEDRAJI_WEB.png" alt="logo" width="150px">
        </a>
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
            </ul>
        </div>
        <form method="GET" action="" class="form-inline">
        <div class="input-group">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar categoría" aria-label="Search" name="categoria" value="<?php echo $categoriaSeleccionada; ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-success" type="submit">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </div>
        </div>
        </form>
        <ul> </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="login.php">
                    <i class="fas fa-shopping-cart"></i> Iniciar Sesión
                </a>
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
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>