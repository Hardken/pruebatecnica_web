<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Consulta de Vuelos</title>
</head>

<body>
  <nav class="navbar">
    <ul class="nav-list">
      <li><a href="home.html">Inicio</a></li>
      <li><a href="consulta.php"> Consulta de vuelos</a></li>
      <li><a href="compra.php"> Compra de billetes</a></li>
    </ul>
  </nav>
  <header>
    <h1>Consulta de Vuelos</h1>
  </header>
  <main>
    <form class="flight-search-form" action="process_consult.php" method="post">
      <label for="origen">Origen:</label>
      <input type="text" id="origen" name="origen">

      <label for="destino">Destino:</label>
      <input type="text" id="destino" name="destino">

      <label for="fecha">Fecha:</label>
      <input type="date" id="fecha" name="fecha">

      <label for="precio">Precio:</label>
      <input type="double" id="precio" name="precio">

      <button type="submit">Buscar Vuelos</button>
    </form>

    <h2>Todos los Vuelos Disponibles:</h2>
    <?php include 'process_consult.php'; ?> <!-- Se incluye el contenido generado por el PHP -->
  </main>
</body>

</html>