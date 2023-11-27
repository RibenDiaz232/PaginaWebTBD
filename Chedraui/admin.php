<?php
include_once 'conexion.php';

// Verificar si se estableció una conexión
if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}

// Configurar la paginación
$porPagina = 10; // Número de productos por página
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Página actual
$inicio = ($pagina - 1) * $porPagina; // Calcular el inicio de los resultados

// Consulta para obtener todas las categorías disponibles
$queryCategorias = "SELECT DISTINCT categoria FROM producto";
$resultadoCategorias = $conexion->query($queryCategorias);

if (!$resultadoCategorias) {
    die("Error en la consulta de categorías: " . $conexion->error);
}

$categorias = [];

while ($filaCategoria = $resultadoCategorias->fetch_assoc()) {
    $categorias[] = $filaCategoria['categoria'];
}

// Verifica si se ha seleccionado una categoría
$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Consulta para obtener productos con paginación y filtrado por categoría
$query = "SELECT * FROM producto";
if ($categoriaSeleccionada) {
    $query .= " WHERE categoria = '$categoriaSeleccionada'";
}
$query .= " LIMIT $inicio, $porPagina";

$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}

$productos = []; // Cambiado el nombre de la variable

while ($fila = $resultado->fetch_assoc()) {
    $productos[] = $fila; // Cambiado el nombre de la variable
}

// Consulta para contar el total de productos
$totalQuery = "SELECT COUNT(*) as total FROM producto";
if ($categoriaSeleccionada) {
    $totalQuery .= " WHERE categoria = '$categoriaSeleccionada'";
}

$totalResult = $conexion->query($totalQuery);
$totalProductos = $totalResult->fetch_assoc()['total'];

// Calcular el total de páginas
$totalPaginas = ceil($totalProductos / $porPagina);

// Cerrar la conexión
$conexion->close();
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
                    <a class="nav-link" href="#">Ventas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listadeproductos.php">Agregar los productos</a>
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
        <!-- Agrega un formulario de selección de categoría -->
        <form method="GET" action="admin.php" class="mb-3">
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria" class="form-control">
                <option value="" <?php echo ($categoriaSeleccionada == '') ? 'selected' : ''; ?>>Todas las categorías</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria; ?>" <?php echo ($categoriaSeleccionada == $categoria) ? 'selected' : ''; ?>><?php echo $categoria; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
        </form>

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
                    <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">
                        <a class="page-link" href="?pagina=<?php echo $i; ?><?php echo ($categoriaSeleccionada) ? '&categoria=' . $categoriaSeleccionada : ''; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

    <!-- Agrega el enlace a la biblioteca Font Awesome para el icono del carrito -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Agrega el enlace a los archivos de Bootstrap JS (jQuery y Popper.js son necesarios) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
