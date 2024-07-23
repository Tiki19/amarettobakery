<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Amaretto Bakery / Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/usuario.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="icon" href="../img/icono.png">
    <script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
</head>
<body>
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
                        <a href="../paginas/cliente.html">Clientes</a>
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
<div class="retroceso">
    <i class="fa-solid fa-chevron-left"></i>
    <a href="../paginas/menu.html" class="btn">Regresar</a>
</div>

<div class="form-container">
    <h2>Agregar Usuario</h2>
    <form id="userForm">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>
        </div>
        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
        </div>
        <div class="form-group">
            <button type="submit">Agregar Usuario</button>
        </div>
    </form>
</div>

<div class="table-container">
    <h2>Lista de Usuarios</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Fecha de Nacimiento</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
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

            // Insertar datos en la tabla usuarios
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $direccion = $_POST['direccion'];
                $fecha_nacimiento = $_POST['fecha_nacimiento'];

                $sql = "INSERT INTO usuarios (nombre, apellido, email, telefono, direccion, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?)";
                
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $nombre, $apellido, $email, $telefono, $direccion, $fecha_nacimiento);

                if ($stmt->execute()) {
                    echo "<script>alert('Usuario agregado exitosamente.');</script>";
                } else {
                    echo "<script>alert('Error: " . $sql . " - " . $conn->error . "');</script>";
                }

                $stmt->close();
            }

            // Mostrar los datos de la tabla usuarios
            $sql = "SELECT id, nombre, apellido, email, telefono, direccion, fecha_nacimiento FROM usuarios";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['apellido']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['telefono']}</td>
                            <td>{$row['direccion']}</td>
                            <td>{$row['fecha_nacimiento']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay usuarios registrados.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById('userForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
</body>
</html>
