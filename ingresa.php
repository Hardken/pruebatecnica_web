<?php
require 'conexion.php';

if (isset($_POST['login'])) {
  $email = $_POST['correo'];
  $password = $_POST['contrasena'];
  $sql = "SELECT * FROM pasajero WHERE email = '$email'";
  $result = mysqli_query($conex, $sql);

  if ($result) {
    $user_data = mysqli_fetch_assoc($result);

    if (password_verify($password, $user_data['contrasena'])) {
      echo "Inicio de sesión exitoso";
      session_start();
      $_SESSION['user_id'] = $user_data['identificacion'];
      $_SESSION['user_nombre'] = $user_data['nombre'];
      header("Location: home.html");
    } else {
      echo "Inicio de sesión fallido";
    }
  } else {
    echo "Error al realizar la consulta: " . mysqli_error($conex);
  }
  
}
?>