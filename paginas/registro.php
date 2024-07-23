<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Amaretto Bakery</title>
    <link rel="icon" href="../img/icono.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="inicio">
        <form action="registro.php" method="POST">
            <h1>Registrar cuenta</h1>
            <div class="btn-input">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="usuario" placeholder="Usuario" required>
                </div>
                <br><br>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="contrasena" placeholder="Contraseña" required>
                </div>
                <br>
            </div>
            <br>
            <button type="submit" class="btn">Registrarse</button>
            <br><br>
            <div class="register">
                <p>¿Ya eres miembro?
                <a href="index.php">Iniciar tu Sesión</a>
            </p>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       // Verificar la conexión a la base de datos
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

        // Obtener datos del formulario
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        // Insertar datos en la base de datos
        $sql = "INSERT INTO login (usuario, contrasena) VALUES ('$usuario', '$contrasena')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Registro exitoso</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <script src="script.js"></script>
</body>
</html>
