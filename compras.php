<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Compras</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Gestión de Compras</h1>
    <nav>
      <a href="index.php">Inicio</a>
      <a href="clientes.php">Clientes</a>
      <a href="proveedores.php">Proveedores</a>
      <a href="productos.php">Productos</a>
      <a href="compras.php">Compras</a>
    </nav>
  </header>

  <div class="container">
    <h2>Registrar Compra</h2>
    <form method="post">
      <select name="dni_cliente">
        <?php
          $clientes = $conn->query("SELECT * FROM cliente");
          while($c = $clientes->fetch_assoc()) {
            echo "<option value='{$c['dni']}'>{$c['nombre']}</option>";
          }
        ?>
      </select>

      <select name="codigo_producto">
        <?php
          $productos = $conn->query("SELECT * FROM producto");
          while($p = $productos->fetch_assoc()) {
            echo "<option value='{$p['codigo']}'>{$p['nombre']}</option>";
          }
        ?>
      </select>

      <button type="submit">Guardar Compra</button>
    </form>

    <h3>Listado de Compras</h3>
    <table>
      <tr><th>Cliente</th><th>Producto</th><th>Proveedor</th><th>Precio</th></tr>
      <?php
        if ($_POST) {
          $stmt = $conn->prepare("INSERT INTO compras (dni_cliente, codigo_producto) VALUES (?, ?)");
          $stmt->bind_param("ii", $_POST['dni_cliente'], $_POST['codigo_producto']);
          $stmt->execute();
        }
        $result = $conn->query("SELECT c.nombre as cliente, p.nombre as producto, pr.nombre as proveedor, p.precio 
                                FROM compras co
                                JOIN cliente c ON co.dni_cliente = c.dni
                                JOIN producto p ON co.codigo_producto = p.codigo
                                JOIN proveedor pr ON p.nif_proveedor = pr.nif");
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>{$row['cliente']}</td><td>{$row['producto']}</td><td>{$row['proveedor']}</td><td>{$row['precio']}</td></tr>";
        }
      ?>
    </table>
  </div>
</body>
</html>
