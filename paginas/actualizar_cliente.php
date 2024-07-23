<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EmpresaDB";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $campo = $_POST['campo'];
    $valor = $_POST['valor'];

    $stmt = $conn->prepare("UPDATE clientes SET " . $campo . " = ? WHERE id = ?");
    $stmt->bind_param("si", $valor, $id);

    if ($stmt->execute()) {
        echo "Actualización exitosa";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
