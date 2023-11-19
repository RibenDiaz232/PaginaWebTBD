<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabla de Búsqueda</title>
  <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h1 class="text-center">Tabla de Búsqueda</h1>

  <!-- Agregar botón para redireccionar a la página de agregar.php -->
  <div class="text-center">
    <a href="agregardatos.php" class="btn btn-success">Agregar Datos</a>
  </div>

  <form action="" method="post" class="mb-4">
    <div class="mb-3">
      <label for="tabla" class="form-label">Selecciona una tabla:</label>
      <select name="tabla" id="tabla" class="form-select">
        <option value="detalleventa">Detalle Venta</option>
        <option value="nomina">Nómina</option>
        <option value="persona">Persona</option>
        <option value="producto">Producto</option>
        <option value="puesto">Puesto</option>
        <option value="sucursal">Sucursal</option>
        <option value="ventas">Ventas</option>
      </select>
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Mostrar Datos</button>
    </div>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tabla = $_POST["tabla"];

    // Crear una instancia de conexión a la base de datos
    $mysqli = new mysqli("localhost", "root", "Winsome1", "chedraui");

    // Checar conexión a la base de datos.
    if ($mysqli->connect_errno) {
      echo "Falló en conectar a MySQL: " . $mysqli->connect_error;
      exit();
    }

    // Consulta para mostrar todos los datos de la tabla seleccionada
    $query = "SELECT * FROM usuario $tabla";
    $result = $mysqli->query($query);

    if (!$result) {
      echo "Error en la consulta: " . $mysqli->error;
      exit();
    }

    echo "<h2 class='text-center'>Datos en la tabla '$tabla':</h2>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead class='table-dark'>";
    echo "<tr>";
    while ($fieldinfo = $result->fetch_field()) {
      echo "<th>{$fieldinfo->name}</th>";
    }
    echo "<th>Acciones</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      foreach ($row as $key => $value) {
        echo "<td>$value</td>";
      }
      echo "<td>";
      echo "<a href='editar.php?tabla=$tabla&id={$row["id$tabla"]}' class='btn btn-warning btn-sm'>Editar</a>";
      echo " ";
      
      echo "<a href='eliminar.php?tabla=$tabla&id={$row["id$tabla"]}' class='btn btn-danger btn-sm'>Eliminar</a>";
      echo "</td>";
      echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";

    // Cerrar la conexión cuando hayas terminado de trabajar con la base de datos.
    $mysqli->close();
  }
  ?>

</div>

<!-- Agrega el enlace al archivo JavaScript de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>