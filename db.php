<?php
$servername = "localhost";
$username = "root"; // El usuario por defecto en XAMPP es 'root'
$password = ""; // La contraseña por defecto en XAMPP es vacía
$dbname = "prueba";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
