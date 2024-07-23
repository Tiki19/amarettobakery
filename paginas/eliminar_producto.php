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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM productos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado exitosamente";
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
}

$conn->close();
?>
