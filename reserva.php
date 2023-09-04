<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Reservar Vuelo</title>
</head>

<body>
  <nav class="navbar">
    <ul class="nav-list">
      <li><a href="home.html">Inicio</a></li>
      <li><a href="consulta.php"> Consulta de vuelos</a></li>
      <li><a href="compra.php"> Compra de billetes</a></li>
    </ul>
  </nav>

  <h1>Reserva de Vuelo</h1>

  <?php
  // Conexión a la base de datos (código de conexión)
  require 'conexion.php';
  // Consulta para obtener los detalles del vuelo
  $vueloNumero;
  if (isset($_GET['numeroVuelo'])) {
    $vueloNumero = $_GET['numeroVuelo'];
    // Realiza las acciones necesarias con el número del vuelo (mostrar detalles, procesar reserva, etc.)
  } // Número de vuelo deseado
  $query = "SELECT V.numero AS numero_vuelo, A.fabricante AS fabricante_avion, A.modelo AS modelo_avion, AP.ciudad AS destino_ciudad, AP.pais AS destino_pais, T.precio AS precio_vuelo
  FROM Vuelo V
  JOIN Avion A ON V.avionIdentificacion = A.identificacion
  JOIN Aeropuerto AP ON V.aeropuertoDestino = AP.nombre
  JOIN VueloTarifa VT ON V.numero = VT.vueloNumero
  JOIN Tarifa T ON VT.tarifaClaseAsiento = T.claseAsiento
  WHERE V.numero = '$vueloNumero'";


  // Ejecutar la consulta
  $result = mysqli_query($conex, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);

    // Mostrar los detalles del vuelo en la página
    echo '<div class="flight-details">';
    echo '<h2>Detalles del Vuelo</h2>';
    echo '<p><strong>Número de Vuelo:</strong> ' . $row['numero_vuelo'] . '</p>';
    echo '<p><strong>Avión:</strong> ' . $row['fabricante_avion'] . ' ' . $row['modelo_avion'] . '</p>';
    echo '<p><strong>Destino:</strong> ' . $row['destino_ciudad'] . ', ' . $row['destino_pais'] . '</p>';
    echo '<p><strong>Precio:</strong> $' . $row['precio_vuelo'] . '</p>';
    echo '</div>';
  } else {
    echo '<p>Error al obtener los detalles del vuelo: ' . mysqli_error($conex) . '</p>';
  }
  ?>

  <form action="procesar_reserva.php" method="post">
    <label for="nombre">Nombre completo:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" required>

    <label for="identificacion">Identificacion:</label>
    <input type="identificacion" id="identificacion" name="identificacion" required>
    <!--
    <?php

    echo '<input type="hidden" name="numeroVuelo" value="' . $vueloNumero . '">'
    ?>

    <label for="claseAsiento">Clase de Asiento:</label>
    <select id="claseAsiento" name="claseAsiento">
    <?php
    // Consulta para obtener las opciones de clase de asiento desde la base de datos
    $queryClases = "SELECT DISTINCT claseAsiento FROM Tarifa";
    $resultClases = mysqli_query($conex, $queryClases);

    if ($resultClases) {
      while ($rowClase = mysqli_fetch_assoc($resultClases)) {
        echo '<option value="' . $rowClase['claseAsiento'] . '">' . $rowClase['claseAsiento'] . '</option>';
      }
    }
    ?>
    </select>
-->
    <button type="submit">Confirmar Reserva</button>
  </form>
</body>

</html>