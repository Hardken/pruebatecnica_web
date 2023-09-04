<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <style>
    /* Oculta el formulario de la tarjeta por defecto */
    .tarjeta-form {
      display: none;
    }
  </style>
  <title>Reservas del Usuario</title>
</head>

<body>
  <nav class="navbar">
    <ul class="nav-list">
    <li><a href="home.html">Inicio</a></li>
      <li><a href="consulta.php"> Consulta de vuelos</a></li>
      <li><a href="compra.php"> Compra de billetes</a></li>
    </ul>
  </nav>

  <h1>Reservas del Usuario</h1>

  <?php
  session_start();
  $host = "localhost";
  $db_user = "root";
  $db_password = "";
  $db_name = "reservas";

  if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
    // Consulta para obtener las reservas del usuario
    $query = "SELECT V.numero AS numero_vuelo, A.fabricante AS fabricante_avion, A.modelo AS modelo_avion, AP.ciudad AS destino_ciudad, AP.pais AS destino_pais, T.precio AS precio_vuelo
              FROM Reserva R
              JOIN Vuelo V ON R.vueloNumero = V.numero
              JOIN Avion A ON V.avionIdentificacion = A.identificacion
              JOIN Aeropuerto AP ON V.aeropuertoDestino = AP.nombre
              JOIN VueloTarifa VT ON V.numero = VT.vueloNumero
              JOIN Tarifa T ON VT.tarifaClaseAsiento = T.claseAsiento
              WHERE R.pasajeroIdentificacion = ?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id]);

    echo "<table>";
    echo "<tr><th>Número de Vuelo</th><th>Avión</th><th>Destino</th><th>Precio</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo "<tr>";
      echo "<td>" . $row['numero_vuelo'] . "</td>";
      echo "<td>" . $row['fabricante_avion'] . " " . $row['modelo_avion'] . "</td>";
      echo "<td>" . $row['destino_ciudad'] . ", " . $row['destino_pais'] . "</td>";
      echo "<td>$" . $row['precio_vuelo'] . "</td>";
      echo '<td><button class="btn-tarjeta" data-vuelo="' . $row['numero_vuelo'] . '">Ingresar Tarjeta</button></td>';
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "Debe iniciar sesión para ver sus reservas.";
  }
  ?>

<div class="tarjeta-form">
    <h2>Ingrese los datos de la tarjeta de crédito</h2>
    <form action="procesar_tarjeta.php" method="post">
      <input type="hidden" name="numeroVuelo" id="tarjetaNumeroVuelo" value="">
      <!-- Agregar los campos para los datos de la tarjeta -->
      <label for="tarjeta">Número de Tarjeta:</label>
    <input type="text" id="tarjeta" name="tarjeta" required>

    <label for="fechaTarjeta">Fecha de Tarjeta:</label>
    <input type="date" id="fechaTarjeta" name="fechaTarjeta" required>

    <label for="empresaTarjeta">Empresa de Tarjeta:</label>
    <input type="text" id="empresaTarjeta" name="empresaTarjeta" required>

      <button type="submit">Realizar Pago</button>
    </form>
  </div>

  <script>
    const btnsTarjeta = document.querySelectorAll('.btn-tarjeta');
    const tarjetaForm = document.querySelector('.tarjeta-form');
    const tarjetaNumeroVuelo = document.getElementById('tarjetaNumeroVuelo');

    btnsTarjeta.forEach(btn => {
      btn.addEventListener('click', () => {
        const numeroVuelo = btn.getAttribute('data-vuelo');
        tarjetaNumeroVuelo.value = numeroVuelo;
        
        // Oculta todos los formularios antes de mostrar uno nuevo
        document.querySelectorAll('.tarjeta-form').forEach(form => {
          form.style.display = 'none';
        });

        tarjetaForm.style.display = 'block';
      });
    });
  </script>

</body>

</html>