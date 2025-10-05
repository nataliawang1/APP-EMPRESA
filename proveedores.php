<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Proveedores</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Gestión de Proveedores</h1>
    <nav>
      <a href="index.php">Inicio</a>
      <a href="clientes.php">Clientes</a>
      <a href="proveedores.php">Proveedores</a>
      <a href="productos.php">Productos</a>
      <a href="compras.php">Compras</a>
    </nav>
  </header>

  <div class="container">
    <h2>Registrar Proveedor</h2>
    <form method="post">
      <input type="text" name="nif" placeholder="NIF" required>
      <input type="text" name="nombre" placeholder="Nombre">
      <input type="text" name="direccion" placeholder="Dirección">
      <button type="submit">Guardar Proveedor</button>
    </form>

    <h3>Lista de Proveedores</h3>
    <table>
      <tr><th>NIF</th><th>Nombre</th><th>Dirección</th></tr>
      <?php
        if ($_POST) {
          $stmt = $conn->prepare("INSERT INTO proveedor (nif, nombre, direccion) VALUES (?, ?, ?)");
          $stmt->bind_param("sss", $_POST['nif'], $_POST['nombre'], $_POST['direccion']);
          $stmt->execute();
        }
        $result = $conn->query("SELECT * FROM proveedor");
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['nif']}</td><td>{$row['nombre']}</td><td>{$row['direccion']}</td></tr>";
        }
      ?>
    </table>
  </div>
</body>
</html>
