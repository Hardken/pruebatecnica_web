<?php

$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "reservas";
// Datos del formulario de registro

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $identificacion = $_POST['identificacion'];
    $usuario = $_POST['usuario'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $nombre = $_POST['nombre'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $direccion = $_POST['direccion'];
    $codigoPostal = $_POST['codigoPostal'];
    $numeroTelefonico = $_POST['numeroTelefonico'];
    $email = $_POST['email'];

    // Consulta de inserción
    $sql = "INSERT INTO pasajero (identificacion, usuario, contrasena, nombre, pais, ciudad, direccion, codigoPostal, numeroTelefonico, email)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$identificacion, $usuario, $contrasena, $nombre, $pais, $ciudad, $direccion, $codigoPostal, $numeroTelefonico, $email]);


    // Redirigir a la página de éxito
    echo '<script>alert("Registro realizado con éxito."); window.location.href = "index.html";</script>';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
