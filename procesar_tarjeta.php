<?php
session_start();
$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "reservas";
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $user_name =$_SESSION['user_nombre'];
  try {
    //code...

  $tarjeta = $_POST['tarjeta'];
  $fechaTarjeta =$_POST['fechaTarjeta'];
  $empresaTarjeta = $_POST['empresaTarjeta'];

  $pdo = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $queryInsertTarjeta = "INSERT INTO tarjeta (numero, fechaVencimiento, nombre, empresaTarjeta, pasajeroIdentificacion) VALUES (?, ?, ?, ?, ?)";
  $stmtInsertTarjeta = $pdo->prepare($queryInsertTarjeta);
  $stmtInsertTarjeta->execute([$tarjeta, $fechaTarjeta, $user_name, $empresaTarjeta, $user_id]);

  echo '<script>alert("Tarjeta registrada con éxito."); window.location.href = "home.html";</script>';
    exit();
  }catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>