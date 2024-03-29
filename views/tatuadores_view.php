<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio de Tatuajes - Clientes</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="fondo">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="cliente_view.php"><img class="logo" src="../assets/img/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
          </button>
      
          <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn" href="#">Nosotrosss</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn" href="#">Tatuadores</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn" href="#">Perforadores</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn" href="#">Intranet</a>
              </li>
            </ul>
          </div>
        </nav>
    </div>


    

  <h1 class="h1-custom">Tatuadores Disponibles</h1>

  <div class="card-container">
    
  <?php
  // Conexión a la base de datos
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "tattoo_studio";
  
  // Crea la conexión
  $conn = new mysqli($servername, $username, $password, $database);
  
  // Verifica la conexión
  if ($conn->connect_error) {
      die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
  }
  
  /// Realizar la consulta a la base de datos para obtener los datos de los tatuadores
  $sql = "SELECT nombre, estilos, imagen_perfil FROM tatuadores";
  $resultado = $conn->query($sql);
  
  // Verificar si se obtuvieron resultados


if ($resultado->num_rows > 0) {
    // Mostrar los datos de los tatuadores
    while ($row = $resultado->fetch_assoc()) {
        echo '<div class="card">';
        echo '<img class="imagen-tatuador" src="' . $row["imagen_perfil"] . '" alt="' . $row["nombre"] . '">';
        echo '<h2>' . $row["nombre"] . '</h2>';
        echo '<p>' . $row["estilos"] . '</p>';
        echo '<a href="tatuadores_view.php" ><button class="btn-ver">Ver </button></a>';
        echo '</div>';
    }
} else {echo "No se encontraron tatuadores.";
}
 
  
  
  // Cierra la conexión a la base de datos
  $conn->close();
  ?>

</body>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>