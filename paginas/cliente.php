<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EmpresaDB";
$port = 3306;

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar datos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['formType'])) {
    if ($_POST['formType'] === 'insert') {
        $nombres = $_POST['nombre'];
        $apellido_paterno = $_POST['Apellido-Paterno'];
        $apellido_materno = $_POST['Apellido-Materno'];
        $celular = $_POST['Celular'];
        $distrito = $_POST['Distrito'];
        $fecha_hora_registro = $_POST['Fecha-Hora-Registro'];

        $sql = "INSERT INTO clientes ( nombres, apellido_paterno, apellido_materno, celular, distrito, fecha_hora_registro) 
                VALUES ('$nombres', '$apellido_paterno', '$apellido_materno', '$celular', '$distrito', '$fecha_hora_registro')";

        if ($conn->query($sql) === TRUE) {
            echo "Nuevo registro creado exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($_POST['formType'] === 'update') {
        $id = $_POST['editId'];
        $nombres = $_POST['editnombres'];
        $apellido_paterno = $_POST['editApellido-Paterno'];
        $apellido_materno = $_POST['editApellido-Materno'];
        $celular = $_POST['editCelular'];
        $distrito = $_POST['editDistrito'];
        $fecha_hora_registro = $_POST['editFecha-Hora-Registro'];

        $stmt = $conn->prepare("UPDATE clientes SET  nombres = ?, apellido_paterno = ?, apellido_materno = ?, celular = ?, distrito = ?, fecha_hora_registro = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $nombres, $apellido_paterno, $apellido_materno, $celular, $distrito, $fecha_hora_registro, $id);

        if ($stmt->execute()) {
            echo "Registro actualizado exitosamente";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Consultar datos
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Amaretto Bakery / Cliente</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="../css/cliente.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="icon" href="../img/icono.png">
    <script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
</head>
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

<body>
    <div class="retroceso">
        <i class="fa-solid fa-chevron-left"></i>
        <a href="../paginas/menu.html" class="btn">Regresar</a>
    </div>

    <!-- Formulario de Inserción -->
    <form id="formCliente" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="formType" value="insert">
        <div class="contenedor">
            <div class="formulario">
                <div class="contener-formulario">
                    <div class="titulo">
                        <h1>Gestionar Clientes</h1>
                    </div>
                    <div class="contenedor-text-input">
                        <div class="registro">
                            <label for="DNI">DNI/RUC:</label>
                            <input type="text" id="DNI" name="DNI" class="redondeadonorelieve">
                        </div>
                        <div class="registro">
                            <label for="nombre">Nombres:</label>
                            <input type="text" id="nombre" name="nombre" class="redondeadonorelieve">
                        </div>
                        <div class="registro">
                            <label for="Apellido-Paterno">Apellido Paterno:</label>
                            <input type="text" id="Apellido-Paterno" name="Apellido-Paterno" class="redondeadonorelieve">
                        </div>
                        <div class="registro">
                            <label for="Apellido-Materno">Apellido Materno:</label>
                            <input type="text" id="Apellido-Materno" name="Apellido-Materno" class="redondeadonorelieve">
                        </div>
                        <div class="registro">
                            <label for="Celular">Celular:</label>
                            <input type="text" id="Celular" name="Celular" required pattern="[0-9]{9}" class="redondeadonorelieve">
                        </div>
                        <div class="registro">
                            <label for="Distrito">Distrito:</label>
                            <input type="text" id="Distrito" name="Distrito" class="redondeadonorelieve">
                        </div>
                        <div class="registro">
                            <label for="Fecha-Hora-Registro">Fecha/Hora de Registro:</label>
                            <input type="datetime-local" id="Fecha-Hora-Registro" name="Fecha-Hora-Registro" class="redondeadonorelieve">
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

    <!-- Tabla de Clientes -->
    <div class="espacio"></div>
    <table class="tabla">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Celular</th>
                <th>Distrito</th>
                <th>Fecha/Hora de registro</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td contenteditable='true' onblur='actualizarCliente(" . htmlspecialchars($row["id"]) . ", \"nombres\", this.innerText)'>" . htmlspecialchars($row["nombres"]) . "</td>";
                    echo "<td contenteditable='true' onblur='actualizarCliente(" . htmlspecialchars($row["id"]) . ", \"apellido_paterno\", this.innerText)'>" . htmlspecialchars($row["apellido_paterno"]) . "</td>";
                    echo "<td contenteditable='true' onblur='actualizarCliente(" . htmlspecialchars($row["id"]) . ", \"apellido_materno\", this.innerText)'>" . htmlspecialchars($row["apellido_materno"]) . "</td>";
                    echo "<td contenteditable='true' onblur='actualizarCliente(" . htmlspecialchars($row["id"]) . ", \"celular\", this.innerText)'>" . htmlspecialchars($row["celular"]) . "</td>";
                    echo "<td contenteditable='true' onblur='actualizarCliente(" . htmlspecialchars($row["id"]) . ", \"distrito\", this.innerText)'>" . htmlspecialchars($row["distrito"]) . "</td>";
                    echo "<td contenteditable='true' onblur='actualizarCliente(" . htmlspecialchars($row["id"]) . ", \"fecha_hora_registro\", this.innerText)'>" . htmlspecialchars($row["fecha_hora_registro"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay datos</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
    function actualizarCliente(id, campo, valor) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'actualizar_cliente.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Actualización exitosa');
            } else {
                console.error('Error en la actualización');
            }
        };
        xhr.send('id=' + id + '&campo=' + campo + '&valor=' + encodeURIComponent(valor));
    }
    </script>
</body>
</html>

<?php
$conn->close();
?>
