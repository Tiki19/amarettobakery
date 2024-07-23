<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Amaretto Bakery / Productos</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="../css/producto.css">
    <link rel="stylesheet" href="../css/menu.css">
    <script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Header -->
    <header class="header-principal">
        <div class="contener-cabezal">
            <div class="cabezal">
                <div class="cliente-pedido">
                    <i class="fa-brands fa-whatsapp"></i>
                    <div class="contener-cliente-pedido">
                        <a href="https://wa.me/968300152" target="_blank">981 902 522</a>
                    </div>
                    <i class="fa-brands fa-instagram"></i>
                    <div class="contener-cliente-pedido">
                        <a href="https://www.instagram.com/amarettobkery/" target="_blank">Amarettobkery</a>
                    </div>
                    <i class="fa-brands fa-facebook"></i>
                    <div class="contener-cliente-pedido">
                        <a href="https://www.facebook.com/Amaretto.Bakery/" target="_blank">Facebook</a>
                    </div>
                </div>
                <div class="contener-logo">
                    <a class="logo-url" href="../paginas/menu.html">
                        <img class="imagen" src="../img/icono.png">
                    </a>
                    <h1 class="logo">
                        <span class="first-word">Amaretto</span>
                        <span class="second-word">Bakery</span>
                    </h1>
                </div>
                <div class="contener-user">
                    <i class="fa-solid fa-user"></i>
                    <div id="header-button">
                        <ul class="nav">
                            <li class="menu-item">
                                <i class="fa-solid fa-bars"></i>
                                <h1>MENÚ</h1>
                                <ul>
                                    <li>
                                        <i class="fa-solid fa-ice-cream"></i>
                                        <a href="../paginas/producto.php">Productos</a>
                                    </li>
                                    <li>
                                        <i class="fa-regular fa-address-book"></i>
                                        <a href="../paginas/cliente.php">Clientes</a>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-user-plus"></i>
                                        <a href="../paginas/usuario.html">Usuarios</a>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-users"></i>
                                        <a href="../paginas/empleado.html">Empleados</a>
                                    </li>
                                    <li>
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <a href="../paginas/venta.html">Venta</a>
                                    </li>
                                    <li>
                                        <i class="fas fa-chart-line"></i>
                                        <a href="../paginas/reporte.html">Reportes</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main>
        <div class="retroceso">
            <i class="fa-solid fa-chevron-left"></i>
            <a href="../paginas/menu.html" class="btn">Regresar</a>
        </div>

        <!-- Product Form -->
        <section class="form-section">
            <form id="formProducto" method="post" action="">
                <div class="contenedor">
                    <div class="formulario">
                        <div class="contener-formulario">
                            <div class="titulo">
                                <h1>Gestionar Productos</h1>
                            </div>
                            <div class="contenedor-text-input">
                                <div class="registro">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" id="nombre" name="nombre" class="redondeadonorelieve" required>
                                </div>

                                <div class="registro">
                                    <label for="Descripcion">Descripcion:</label>
                                    <input type="text" id="Descripcion" name="Descripcion" class="redondeadonorelieve" required>
                                </div>

                                <div class="registro">
                                    <label for="Presentacion">Presentacion:</label>
                                    <input type="text" id="Presentacion" name="Presentacion" class="redondeadonorelieve" required>
                                </div>

                                <div class="registro">
                                    <label for="Precio">Precio:</label>
                                    <input type="text" id="Precio" name="Precio" class="redondeadonorelieve" required>
                                </div>

                                <div class="registro">
                                    <label for="Stock">Stock:</label>
                                    <input type="text" id="Stock" name="Stock" class="redondeadonorelieve" required>
                                </div>

                                <div class="registro">
                                    <label for="categorias">Categorías:</label>
                                    <select id="categorias" name="categorias" class="redondeadonorelieve" required>
                                        <option disabled selected hidden>-- Seleccione una categoría --</option>
                                        <option value="Pasteles">Pasteles</option>
                                        <option value="Postres">Postres</option>
                                        <option value="Panes">Panes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="contener-botones">
                            <div class="botones">
                                <input type="submit" value="Guardar">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <!-- Products Table -->
        <section class="table-section">
            <div class="espacio"></div>
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Presentacion</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categorías</th>
                    </tr>
                </thead>
                <tbody id="contenedor-filas">
                    <?php
                        $servername = "localhost";
                        $username = "root"; // Cambia esto si es necesario
                        $password = ""; // Cambia esto si es necesario
                        $dbname = "EmpresaDB";
                        $port = 3306; // Puerto de MySQL en XAMPP

                        // Crear conexión
                        $conn = new mysqli($servername, $username, $password, $dbname, $port);

                        // Comprobar conexión
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        // Insertar datos en la base de datos
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $nombre = $_POST['nombre'];
                            $descripcion = $_POST['Descripcion'];
                            $presentacion = $_POST['Presentacion'];
                            $precio = $_POST['Precio'];
                            $stock = $_POST['Stock'];
                            $categoria = $_POST['categorias'];

                            $sql = "INSERT INTO productos (nombre, descripcion, presentacion, precio, stock, categoria) VALUES ('$nombre', '$descripcion', '$presentacion', '$precio', '$stock', '$categoria')";

                            if ($conn->query($sql) === TRUE) {
                                echo "<p>Producto registrado exitosamente</p>";
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                        }

                        // Mostrar datos de la base de datos
                        $sql = "SELECT * FROM productos";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td contenteditable='true' class='editable' data-id='" . $row["id"] . "' data-field='nombre'>" . $row["nombre"] . "</td>
                                <td contenteditable='true' class='editable' data-id='" . $row["id"] . "' data-field='descripcion'>" . $row["descripcion"] . "</td>
                                <td contenteditable='true' class='editable' data-id='" . $row["id"] . "' data-field='presentacion'>" . $row["presentacion"] . "</td>
                                <td contenteditable='true' class='editable' data-id='" . $row["id"] . "' data-field='precio'>" . $row["precio"] . "</td>
                                <td contenteditable='true' class='editable' data-id='" . $row["id"] . "' data-field='stock'>" . $row["stock"] . "</td>
                                <td contenteditable='true' class='editable' data-id='" . $row["id"] . "' data-field='categoria'>" . $row["categoria"] . "</td>
                                <td><button class='eliminar-btn' data-id='" . $row["id"] . "'>Eliminar</button></td>
                              </tr>";
                        
                            }
                        } else {
                            echo "<tr><td colspan='7'>No hay productos registrados</td></tr>";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const editableElements = document.querySelectorAll('.editable');

        editableElements.forEach(element => {
            element.addEventListener('blur', function() {
                const id = this.getAttribute('data-id');
                const field = this.getAttribute('data-field');
                const value = this.textContent;

                const formData = new FormData();
                formData.append('id', id);
                formData.append(field, value);

                fetch('update_producto.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const eliminarButtons = document.querySelectorAll('.eliminar-btn');

    eliminarButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');

            // Confirmar la eliminación
            if (confirm('¿Estás seguro de eliminar este producto?')) {
                fetch('eliminar_producto.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + encodeURIComponent(productId),
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data); // Manejar la respuesta del servidor (opcional)
                    // Opcional: remover la fila eliminada de la tabla en el cliente
                    this.closest('tr').remove();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });
});
</script>

</body>
</html>
