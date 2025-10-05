<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Productos</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Gestión de Productos</h1>
    <nav>
      <a href="index.php">Inicio</a>
      <a href="clientes.php">Clientes</a>
      <a href="proveedores.php">Proveedores</a>
      <a href="productos.php">Productos</a>
      <a href="compras.php">Compras</a>
    </nav>
  </header>

  <div class="container">
    <h2>Registrar Producto</h2>
    <form method="post">
      <input type="text" name="codigo" placeholder="Código" required>
      <input type="text" name="nombre" placeholder="Nombre">
      <input type="number" step="0.01" name="precio" placeholder="Precio">
      <select name="nif_proveedor">
        <?php
          $proveedores = $conn->query("SELECT * FROM proveedor");
          while($p = $proveedores->fetch_assoc()) {
            echo "<option value='{$p['nif']}'>{$p['nombre']}</option>";
          }
        ?>
      </select>
      <button type="submit">Guardar Producto</button>
    </form>

    <h3>Lista de Productos</h3>
    <table>
      <tr><th>Código</th><th>Nombre</th><th>Precio</th><th>Proveedor</th></tr>
      <?php
        if ($_POST) {
          $stmt = $conn->prepare("INSERT INTO producto (codigo, nombre, precio, nif_proveedor) VALUES (?, ?, ?, ?)");
          $stmt->bind_param("isds", $_POST['codigo'], $_POST['nombre'], $_POST['precio'], $_POST['nif_proveedor']);
          $stmt->execute();
        }
        $result = $conn->query("SELECT p.codigo, p.nombre, p.precio, pr.nombre as proveedor 
                                FROM producto p 
                                JOIN proveedor pr ON p.nif_proveedor = pr.nif");
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['codigo']}</td><td>{$row['nombre']}</td><td>{$row['precio']}</td><td>{$row['proveedor']}</td></tr>";
        }
      ?>
    </table>
  </div>
</body>
</html>
