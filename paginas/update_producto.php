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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $field = array_keys($_POST)[1]; // el segundo campo es el campo editable
    $value = $_POST[$field];

    $sql = "UPDATE productos SET $field='$value' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto actualizado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
