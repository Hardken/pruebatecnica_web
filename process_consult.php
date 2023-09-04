<?php
$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "reservas";

try {
  // Conexión a la base de datos
  $pdo = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Consulta a la base de datos (si se envió el formulario)
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $fecha = $_POST['fecha'];
    $precio = $_POST['precio'];

    if ($origen != "") {
      $sql = "SELECT V.numero, A.nombre AS aerolineaNombre, V.aeropuertoOrigen, V.aeropuertoDestino, V.fechaLlegada, V.fechaSalida, T.precio
              FROM Vuelo V
              JOIN Aerolinea A ON V.aerolineaNombre = A.nombre
              JOIN VueloTarifa VT ON V.numero = VT.vueloNumero
              JOIN Tarifa T ON VT.tarifaClaseAsiento = T.claseAsiento
              WHERE V.aeropuertoOrigen Like ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(["%$origen%"]);
    } elseif ($destino != "") {
      $sql = "SELECT V.numero, A.nombre AS aerolineaNombre, V.aeropuertoOrigen, V.aeropuertoDestino, V.fechaLlegada, V.fechaSalida, T.precio
              FROM Vuelo V
              JOIN Aerolinea A ON V.aerolineaNombre = A.nombre
              JOIN VueloTarifa VT ON V.numero = VT.vueloNumero
              JOIN Tarifa T ON VT.tarifaClaseAsiento = T.claseAsiento
              WHERE V.aeropuertoDestino Like ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(["%$destino%"]);
    } elseif ($fecha != "") {
      $sql = "SELECT V.numero, A.nombre AS aerolineaNombre, V.aeropuertoOrigen, V.aeropuertoDestino, V.fechaLlegada, V.fechaSalida, T.precio
              FROM Vuelo V
              JOIN Aerolinea A ON V.aerolineaNombre = A.nombre
              JOIN VueloTarifa VT ON V.numero = VT.vueloNumero
              JOIN Tarifa T ON VT.tarifaClaseAsiento = T.claseAsiento
              WHERE V.fechaSalida Like ?";;
      $stmt = $pdo->prepare($sql);
      $stmt->execute(["%$fecha%"]);
    } elseif ($precio != "") {
      $sql = "SELECT V.numero, A.nombre AS aerolineaNombre, V.aeropuertoOrigen, V.aeropuertoDestino, V.fechaLlegada, V.fechaSalida, T.precio
              FROM Vuelo V
              JOIN Aerolinea A ON V.aerolineaNombre = A.nombre
              JOIN VueloTarifa VT ON V.numero = VT.vueloNumero
              JOIN Tarifa T ON VT.tarifaClaseAsiento = T.claseAsiento
              WHERE T.precio Like ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(["%$precio%"]);
    }
  } else {
    // Consulta para mostrar todos los vuelos disponibles
    $sql = "SELECT V.numero, A.nombre AS aerolineaNombre, V.aeropuertoOrigen, V.aeropuertoDestino, V.fechaLlegada, V.fechaSalida, T.precio, T.claseAsiento
              FROM Vuelo V
              JOIN Aerolinea A ON V.aerolineaNombre = A.nombre
              JOIN VueloTarifa VT ON V.numero = VT.vueloNumero
              JOIN Tarifa T ON VT.tarifaClaseAsiento = T.claseAsiento";

    $stmt = $pdo->query($sql);
  }

  // Mostrar resultados
  echo "<table>";
  echo "<tr><th>Número de Vuelo</th><th>Aerolinea</th><th>Aeropuerto de Origen</th><th>Aeropuerto de Salida</th><th>Fecha de Llegada</th><th>Fecha de Salida</th><th>Clase de asiento</th><th>Precio</th><th></th><th></th></tr>";
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['numero'] . "</td>";
    echo "<td>" . $row['aerolineaNombre'] . "</td>";
    echo "<td>" . $row['aeropuertoOrigen'] . "</td>";
    echo "<td>" . $row['aeropuertoDestino'] . "</td>";
    echo "<td>" . $row['fechaLlegada'] . "</td>";
    echo "<td>" . $row['fechaSalida'] . "</td>";
    echo "<td>" . $row['claseAsiento'] . "</td>";
    echo "<td>" . $row['precio'] . "</td>";
    echo "<td><button onclick=\"reservarVuelo('" . $row['numero'] . "')\">Reservar</button></td>";
    echo "<td><button onclick=\"comprarVuelo('" . $row['numero'] . "')\">Comprar</button></td>";
    echo "</tr>";
  }
  echo "</table>";
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>
<script>
  function reservarVuelo(numeroVuelo) {
    window.location.href = "reserva.php?numeroVuelo=" + numeroVuelo;
    // Aquí podrías agregar el código para registrar la reserva en la base de datos si es necesario
  }

  function comprarVuelo(numeroVuelo) {
    window.location.href = "compra.php"
    // Aquí podrías agregar el código para procesar la compra si es necesario
  }
</script>