<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amaretto Bakery / Venta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/venta.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <link rel="icon" href="../img/icono.png">
    <script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="retroceso">
        <i class="fa-solid fa-chevron-left"></i>
        <a href="../paginas/menu.html" class="btn">Regresar</a>
    </div>

    <header>
        <h1>Venta de Productos</h1>
    </header>
    <main>
        <section class="productos">
            <div class="buscador">
                <input type="text" id="buscarProducto" placeholder="Buscar producto...">
            </div>
            <div class="productos-container">
                <!-- Productos aquí -->
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
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Obtener productos de la base de datos
                $sql = "SELECT id, nombre, descripcion, precio FROM productos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Mostrar productos
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="producto">';
                        echo '<h2>' . $row["nombre"] . '</h2>';
                        echo '<p>' . $row["descripcion"] . '</p>';
                        echo '<p>Precio: $' . $row["precio"] . '</p>';
                        echo '<button class="agregar-btn" onclick="agregarProducto(' . $row["id"] . ', \'' . $row["nombre"] . '\', ' . $row["precio"] . ')">Agregar</button>';
                        echo '</div>';
                    }
                } else {
                    echo "0 resultados";
                }

                $conn->close();
                ?>
            </div>
        </section>
        
        <section class="boleta">
            <h2>Boleta de Compra</h2>
            <table id="boleta">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="boleta-body">
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Total:</td>
                        <td id="total">0.00</td>
                    </tr>
                </tfoot>
            </table>
            <form id="cliente-form" method="POST" action="">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre_cliente" required>

                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono_cliente" required pattern="[0-9]{9}">

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion_cliente" required>

                <input type="hidden" id="productos" name="productos">
                <input type="hidden" id="total_final" name="total_final">

                <button type="submit">Confirmar Compra</button>
            </form>
        </section>
        <button onclick="generarPDF()">Generar Boleta</button>
    </main>

    <script>
        let total = 0;
        const productosBoleta = [];

        function agregarProducto(id, nombre, precio) {
            const boletaBody = document.getElementById('boleta-body');
            const fila = document.createElement('tr');

            fila.innerHTML = `
                <td>${nombre}</td>
                <td>$${precio.toFixed(2)}</td>
                <td><button onclick="eliminarProducto(this, ${precio})">Eliminar</button></td>
            `;

            boletaBody.appendChild(fila);

            total += precio;
            document.getElementById('total').innerText = total.toFixed(2);

            productosBoleta.push({ id, nombre, precio });
            document.getElementById('productos').value = JSON.stringify(productosBoleta);
            document.getElementById('total_final').value = total.toFixed(2);
        }

        function eliminarProducto(boton, precio) {
            const fila = boton.parentNode.parentNode;
            fila.parentNode.removeChild(fila);

            total -= precio;
            document.getElementById('total').innerText = total.toFixed(2);

            const index = productosBoleta.findIndex(producto => producto.precio === precio);
            productosBoleta.splice(index, 1);
            document.getElementById('productos').value = JSON.stringify(productosBoleta);
            document.getElementById('total_final').value = total.toFixed(2);
        }

        function generarPDF() {
            // Lógica para generar PDF
        }
    </script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener datos del formulario
    $nombre_cliente = $_POST['nombre_cliente'];
    $telefono_cliente = $_POST['telefono_cliente'];
    $direccion_cliente = $_POST['direccion_cliente'];
    $productos = json_decode($_POST['productos'], true);
    $total_final = $_POST['total_final'];

    // Insertar datos en la tabla ventas
    foreach ($productos as $producto) {
        $producto_id = $producto['id'];
        $precio = $producto['precio'];

        $sql = "INSERT INTO ventas (producto_id, precio, nombre_cliente, telefono_cliente, direccion_cliente) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("idsss", $producto_id, $precio, $nombre_cliente, $telefono_cliente, $direccion_cliente);

        if ($stmt->execute()) {
            echo "<script>alert('Compra realizada exitosamente.');</script>";
        } else {
            echo "<script>alert('Error: " . $sql . " - " . $conn->error . "');</script>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
