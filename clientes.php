<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Clientes</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Gestión de Clientes</h1>
    <nav>
      <a href="index.php">Inicio</a>
      <a href="clientes.php">Clientes</a>
      <a href="proveedores.php">Proveedores</a>
      <a href="productos.php">Productos</a>
      <a href="compras.php">Compras</a>
    </nav>
  </header>

  <div class="container">
    <h2>Registrar Cliente</h2>
    <form method="post">
      <input type="text" name="dni" placeholder="DNI" required>
      <input type="text" name="nombre" placeholder="Nombre">
      <input type="date" name="fecha_na">
      <input type="text" name="tfno" placeholder="Teléfono">
      <button type="submit">Guardar Cliente</button>
    </form>

    <h3>Lista de Clientes</h3>
    <table>
      <tr><th>DNI</th><th>Nombre</th><th>Fecha Nacimiento</th><th>Teléfono</th></tr>
      <?php
        if ($_POST) {
          $stmt = $conn->prepare("INSERT INTO cliente (dni, nombre, fecha_na, tfno) VALUES (?, ?, ?, ?)");
          $stmt->bind_param("isss", $_POST['dni'], $_POST['nombre'], $_POST['fecha_na'], $_POST['tfno']);
          $stmt->execute();
        }
        $result = $conn->query("SELECT * FROM cliente");
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['dni']}</td><td>{$row['nombre']}</td><td>{$row['fecha_na']}</td><td>{$row['tfno']}</td></tr>";
        }
      ?>
    </table>
  </div>
</body>
</html>
