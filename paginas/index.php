<?php
session_start();

// Verificar si ya hay un error en la URL
$error = isset($_GET['error']) && $_GET['error'] === '1';

// Verificar la conexión a la base de datos
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

// Manejar el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar las credenciales
    $stmt = $conn->prepare("SELECT * FROM Login WHERE usuario = ? AND contrasena = ?");
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Credenciales correctas, redirigir a menu.html
        header("Location: menu.html");
        exit();
    } else {
        // Credenciales incorrectas, redirigir de nuevo con error
        header("Location: index.php?error=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Ruta al CSS -->
    <link rel="icon" href="img/icono.png"> <!-- Ruta al ícono -->
    <title>Amaretto Bakery</title>
    <script>
        // Función para mostrar una alerta si hay un error en la URL
        function showError() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('error') === '1') {
                alert('Credenciales incorrectas. Por favor, intente de nuevo.');
            }
        }

        // Ejecutar la función cuando el contenido esté cargado
        document.addEventListener('DOMContentLoaded', showError);
    </script>
</head>
<body>
    <div class="welcome">
        <h1>Bienvenido a pastelería & panadería</h1>
        <h1> Amaretto Bakery</h1>
    </div>
    <div class="inicio">
        <form action="index.php" method="post">
            <h1>Inicio de Sesión</h1>
            <br><br>
            <div class="btn-input">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" name="usuario" placeholder="Ingrese Usuario" required>
                </div>
                <br><br>
                <div class="btn-input">
                    <div class="input-container">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="contrasena" placeholder="Ingrese su Contraseña" required>
                    </div>
                </div>
                <br><br>
                <button type="submit" class="btn">Iniciar Sesión</button>
                <div class="inicio-sesion">
                    <p>¿Aún no estás registrado?
                    <a href="registro.php">Regístrate</a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
