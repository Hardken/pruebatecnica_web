<?php
// Conexión a la base de datos (código de conexión)

$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "reservas";
session_start();
// Comprobar si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtener los datos del formulario
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $tarjeta = $_POST['tarjeta'];
  $claseAsiento = $_POST['claseAsiento'];
  $numeroVuelo = $_POST['numeroVuelo'];
  $identificacion = $_POST['identificacion'];
  $fechaTarjeta =$_POST['fechaTarjeta'];
  $empresaTarjeta = $_POST['empresaTarjeta'];

  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
  try {
    // Insertar los datos en la tabla Reserva
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $queryInsertReserva = "INSERT INTO Reserva (vueloNumero, pasajeroIdentificacion) VALUES (?, ?)";
    $stmtInsertReserva = $pdo->prepare($queryInsertReserva);
    $stmtInsertReserva->execute([$numeroVuelo, $user_id]);

    // Insertar los datos en la tabla Tarjeta
    // Actualizar la tabla Vuelo para marcar el asiento como reservado (ejemplo)

    // Mostrar una alerta y redirigir al index
    echo '<script>alert("Reserva realizada con éxito."); window.location.href = "home.html";</script>';
    exit();
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
} else {
  // Si no se han enviado los datos del formulario, redirigir a una página de error o mostrar un mensaje
  
  exit();
}
?>
