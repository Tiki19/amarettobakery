<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Amaretto Bakery / Reportes de Ventas</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="../css/reporte.css">
    <link rel="icon" href="../img/icono.png">
</head>

<body>
    <div class="retroceso">
        <i class="fa-solid fa-chevron-left"></i>
        <a href="../paginas/menu.html" class="btn">Regresar</a>
    </div>

    <h1 >Reporte de Ventas</h1>

    <table class="ventas-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto ID</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Nombre Cliente</th>
                <th>Teléfono Cliente</th>
                <th>Dirección Cliente</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root"; // Cambia esto si es necesario
            $password = ""; // Cambia esto si es necesario
            $dbname = "EmpresaDB";
            $port = 3306; // Puerto de MySQL en XAMPP

            // Crear conexión
            $conn = new mysqli($servername, $username, $password, $dbname, $port);

            // Verificar conexión
            if ($conn->connect_error) {
                die("Error en la conexión: " . $conn->connect_error);
            }

            // Consulta SQL para obtener los datos de la tabla ventas
            $sql = "SELECT id, producto_id, precio, stock, nombre_cliente, telefono_cliente, direccion_cliente FROM ventas";
            $result = $conn->query($sql);

            // Mostrar los datos en la tabla
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["producto_id"] . "</td>";
                    echo "<td>$" . number_format($row["precio"], 2) . "</td>";
                    echo "<td>" . $row["stock"] . "</td>";
                    echo "<td>" . $row["nombre_cliente"] . "</td>";
                    echo "<td>" . $row["telefono_cliente"] . "</td>";
                    echo "<td>" . $row["direccion_cliente"] . "</td>";
                    echo "<td><form action='generar_boleta.php' method='post'><input type='hidden' name='venta_id' value='" . $row["id"] . "'><button type='submit'>Generar Boleta</button></form></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No se encontraron ventas.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

    <script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
</body>
</html>
